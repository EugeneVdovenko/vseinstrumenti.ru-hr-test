<?php

namespace App\Entities;

use Doctrine\ORM\Annotation as ORM;

/**
 * Сущности статусов оплаты
 * @package App\Entities
 */
class PaymentStatus {
    const STATUS_WAIT = 1;
    const STATUS_SUCCEED = 2;
    const STATUS_FAIL = 3;

    /**
     * Названия статусов заказа
     *
     * @return array
     */
    static function getTitles()
    {
        return [
            self::STATUS_WAIT => "Ожжидание оплаты",
            self::STATUS_SUCCEED => "Оплата прошла успешно",
            self::STATUS_FAIL => "Ошибка оплаты заказа",
        ];
    }
}
