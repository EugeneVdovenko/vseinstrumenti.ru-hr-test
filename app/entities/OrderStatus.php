<?php

namespace App\Entities;

/**
 * Сущности статусов заказа
 *
 * @package App\Entities
 */
class OrderStatus {
    const STATUS_NEW = 1;
    const STATUS_PAID = 2;

    /**
     * Названия статусов заказа
     *
     * @return array
     */
    static function getTitles()
    {
        return [
            self::STATUS_NEW => "Новый",
            self::STATUS_PAID => "Оплачен"
        ];
    }
}
