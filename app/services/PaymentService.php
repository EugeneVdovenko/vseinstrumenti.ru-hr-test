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
class PaymentService
{
    /** @var Client */
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://yandex.ru',
        ]);
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

            $payment->setId(mt_rand(1, 999));
            $payment->setStatus(PaymentStatus::STATUS_WAIT);
            $payment->setOrderId($order->getId());
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
                'form_params' => [
                    'order' => $payment->getOrderId(),
                    'amount' => (mt_rand(10000, 99999)/100),
                ],
            ]);

            return ($response->getStatusCode() === Response::HTTP_OK);
        } catch (GuzzleException $e) {
            return false;
        }
    }
}
