<?php

namespace App\Entities;

/**
 * Сущность с данными заказа
 *
 * @package App\Entities
 */
class Order implements \JsonSerializable {
    /** @var int */
    protected $id;

    /** @var OrderStatus */
    protected $status;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return OrderStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param OrderStatus $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
