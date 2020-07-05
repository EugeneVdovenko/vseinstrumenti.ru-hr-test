<?php

namespace App\Entities;

use Doctrine\ORM\Annotation as ORM;

/**
 * Сущность с данными товара
 * @package App\Entities
 *
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product implements \JsonSerializable {
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    protected $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entities\Order", inversedBy="products")
     */
    protected $orders;

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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @return Order[]
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param Order[] $orders
     */
    public function setOrders($orders)
    {
        $this->orders = $orders;
    }
}
