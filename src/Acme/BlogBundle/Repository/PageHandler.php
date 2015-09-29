<?php

/**
 * Created by PhpStorm.
 * User: R
 * Date: 2015-09-28
 * Time: 16:47
 */

namespace Acme\BlogBundle\Repository;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;

class PageHandler
{
    public $repository;

    public function __construct(ObjectManager $em, $entityClass)
    {
        $this->repository = $em->getRepository($entityClass);
    }

    public function get($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param mixed $repository
     */
    public function setRepository(EntityManager $repository)
    {
        $this->repository = $repository;
    }

}