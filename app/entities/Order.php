<?php

namespace App\Entities;

use Doctrine\ORM\Annotation as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Сущность с данными заказа
 * @package App\Entities
 *
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class Order implements \JsonSerializable {
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $status;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entities\Product", inversedBy="orders")
     * @ORM\JoinTable(name="orders_products",
     *      joinColumns={@ORM\JoinColumn(name="order_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     *      )
     */
    protected $products;

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
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
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

    /**
     * @return PersistentCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }
}
