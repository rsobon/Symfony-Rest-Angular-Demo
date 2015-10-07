<?php

/**
 * Created by PhpStorm.
 * User: R
 * Date: 2015-09-28
 * Time: 16:47
 */

namespace Acme\BlogBundle\Repository;

use Acme\BlogBundle\Entity\IPage;
use Doctrine\ORM\EntityManager;

class PageHandler implements IPageHandler
{
    private $repository;
    /**
     * @var $em EntityManager
     */
    private $em;

    public function __construct(EntityManager $em, $entityClass)
    {
        $this->repository = $em->getRepository($entityClass);
        $this->em = $em;
    }

    public function get($id)
    {
        return $this->repository->find($id);
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function post($page)
    {

        $this->em->persist($page);
        $this->em->flush();

        return $this->repository->findAll();
    }

    private function processForm(IPage $page, array $parameters, $method = "PUT")
    {

    }

}