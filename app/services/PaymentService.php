<?php

namespace App\Services;

use App\Entities\Payment;
use App\Entities\Product;

/**
 * Сервис для бизнес-логики работы с оплатами
 *
 * @package App\Services
 */
class PaymentService
{
    /**
     * Создание оплаты для заказа
     *
     * @param $order
     * @return Payment
     */
    public function createPayment($order)
    {
        $payment = new Payment();

        return $payment;
    }

    /**
     * Оплата заказа
     *
     * @param $payment
     * @return bool
     */
    public function sendPayment($payment)
    {
        return true;
    }
}