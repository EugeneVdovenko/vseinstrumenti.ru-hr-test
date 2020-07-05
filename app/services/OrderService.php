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
        $order->setProducts($products);
        $this->em->persist($order);
        $this->em->flush();

        return $order;
    }

    /**
     * Подсчет суммы заказа
     *
     * @param Order $order
     * @return float
     */
    public function getAmount(Order $order)
    {
        $products = $order->getProducts()->toArray();
        return array_reduce($products, function ($sum, Product $product) {
            $sum += $product->getPrice();
            return $sum;
        }, 0);
    }
}