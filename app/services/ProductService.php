<?php

namespace App\Services;

use App\Entities\Product;

/**
 * Сервис для бизнес-логики работы с товарами
 *
 * @package App\Services
 */
class ProductService extends AbstractService
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
            $product->setTitle("Товар " . mt_rand(1, 9999999));
            $product->setPrice(mt_rand(1000, 9999)/100);
            $this->em->persist($product);
            $this->em->flush();
            $products[] = $product;
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
        /** @var Product[] $products */
        if ($ids) {
            $products = $this->em->getRepository(Product::class)->findBy(['id' => $ids]);
        } else {
            $products = $this->em->getRepository(Product::class)->findAll();
        }

        return $products;
    }
}