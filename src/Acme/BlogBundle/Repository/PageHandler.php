<?php

/**
 * Created by PhpStorm.
 * User: R
 * Date: 2015-09-28
 * Time: 16:47
 */

namespace Acme\BlogBundle\Repository;

use Doctrine\ORM\EntityManager;

class PageHandler implements IPageHandler
{
    private $repository;

    public function __construct(EntityManager $em, $entityClass)
    {
        $this->repository = $em->getRepository($entityClass);
    }

    public function get($id)
    {
        return $this->repository->find($id);
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

}