<?php

namespace App\Services;

use App\Entities\Product;

/**
 * Сервис для бизнес-логики работы с товарами
 *
 * @package App\Services
 */
class ProductService
{
    /**
     * Генерация товаров для теста
     *
     * @param int $num
     * @return array
     */
    public function generate($num = 1)
    {
        $products = [];

        for ($i = 1; $i <= $num; $i++) {
            $product = new Product();
            $product->setId($i);
            $product->setTitle("Товар {$i}");
            $product->setPrice(mt_rand(1000, 9999)/100);
            $products[] = $product;
            unset($product);
        }

        return $products;
    }

    /**
     * Получаем список товаров (с фильтрацией по id товара)
     *
     * @param array $ids
     * @return array
     */
    public function getProducts($ids = [])
    {
        // товары для теста создания заказа
        /** @var Product[] $products */
        $products = $this->generate(mt_rand(1, 9));

        return $products;
    }
}