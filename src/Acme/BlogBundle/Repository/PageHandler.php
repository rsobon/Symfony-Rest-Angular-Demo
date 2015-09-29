<?php

/**
 * Created by PhpStorm.
 * User: R
 * Date: 2015-09-28
 * Time: 16:47
 */

namespace Acme\BlogBundle\Repository;

use Doctrine\Common\Persistence\ObjectManager;

class PageHandler implements IPageHandler
{
    private $repository;

    public function __construct(ObjectManager $em, $entityClass)
    {
        $this->repository = $em->getRepository($entityClass);
    }

    public function get($id)
    {
        return $this->repository->find($id);
    }

}