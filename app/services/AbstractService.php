<?php


namespace App\Services;


use Doctrine\ORM\EntityManager;

abstract class AbstractService
{
    /** @var EntityManager */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}