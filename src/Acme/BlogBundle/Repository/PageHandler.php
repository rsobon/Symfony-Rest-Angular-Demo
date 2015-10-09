<?php

/**
 * Created by PhpStorm.
 * User: R
 * Date: 2015-09-28
 * Time: 16:47
 */

namespace Acme\BlogBundle\Repository;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageHandler
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
        $page = $this->repository->find($id);

        if(!$page) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        } else {
            return $page;
        }
    }

    public function getAll()
    {
        $pages = $this->repository->findAll();

        if(!$pages) {
            throw new NotFoundHttpException(sprintf('The resources were not found.'));
        } else {
            return $pages;
        }
    }

    public function save($page)
    {
        $this->em->persist($page);
        $this->em->flush();
    }

}