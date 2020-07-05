<?php

namespace App\Services;

use App\Entities\Order;
use App\Entities\OrderStatus;
use App\Entities\Payment;
use App\Entities\PaymentStatus;
use App\Entities\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Сервис для бизнес-логики работы с оплатами
 *
 * @package App\Services
 */
class PaymentService extends AbstractService
{
    /** @var Client */
    protected $client;

    public function __construct($em)
    {
        $this->client = new Client([
            'base_uri' => 'https://yandex.ru',
        ]);

        parent::__construct($em);
    }

    /**
     * Создание оплаты для заказа
     *
     * @param Order $order
     * @return Payment
     */
    public function createPayment(Order $order)
    {
        $payment = null;

        if ($order->getStatus() === OrderStatus::STATUS_NEW) {
            $payment = new Payment();
            $payment->setStatus(PaymentStatus::STATUS_WAIT);
            $payment->setOrderId($order->getId());
            $this->em->persist($payment);
            $this->em->flush();
        }

        return $payment;
    }

    /**
     * Оплата заказа
     *
     * @param Payment $payment
     * @return bool
     */
    public function sendPayment(Payment $payment)
    {
        try {
            $response = $this->client->get('/', [
                'query' => [
                    'order' => $payment->getOrderId(),
                    'amount' => (mt_rand(10000, 99999)/100),
                ],
            ]);

            if ($response->getStatusCode() === Response::HTTP_OK) {
                $payment->setStatus(PaymentStatus::STATUS_SUCCEED);
                $this->em->flush();
                return true;
            }

            $payment->setStatus(PaymentStatus::STATUS_FAIL);
            $this->em->flush();
            return false;
        } catch (GuzzleException $e) {
            $payment->setStatus(PaymentStatus::STATUS_FAIL);
            $this->em->flush();
            return false;
        }
    }
}
