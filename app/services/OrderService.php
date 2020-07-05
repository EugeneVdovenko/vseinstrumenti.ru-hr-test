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
class OrderService extends AbstractService
{
    /**
     * Поиск заказа по ID
     *
     * @param $id
     * @return Order
     */
    public function getOrder($id)
    {
        /** @var Order $order */
        $order = $this->em->getRepository(Order::class)->findOneBy(['id' => $id]);

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
        $order->setStatus(OrderStatus::STATUS_NEW);

        $this->em->persist($order);
        $this->em->flush();

        return $order;
    }
}