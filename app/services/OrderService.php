<?php

namespace App\Services;

use App\Entities\Order;
use App\Entities\OrderStatus;
use App\Entities\Product;

/**
 * Сервис для бизнес-логики работы с заказами
 *
 * @package App\Services
 */
class OrderService
{
    /**
     * Поиск заказа по ID
     *
     * @param $id
     * @return Order
     */
    public function getOrder($id)
    {
        $order = new Order();
        $order->setId($id);
        $order->setStatus(OrderStatus::STATUS_NEW);

        return $order;
    }

    /**
     * Создание заказа
     *
     * @param Product[] $products
     * @return Order
     */
    public function createOrder($products)
    {
        $order = new Order();

        $order->setId(mt_rand(1, 100));
        $order->setStatus(OrderStatus::STATUS_NEW);

        return $order;
    }
}