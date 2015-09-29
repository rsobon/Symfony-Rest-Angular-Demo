<?php
/**
 * Created by PhpStorm.
 * User: R
 * Date: 2015-09-28
 * Time: 16:29
 */

namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\Repository\PageHandler;
use FOS\RestBundle\Controller\FOSRestController;
use Acme\BlogBundle\Entity\Page;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends FOSRestController
{
    public function getPageAction($id)
    {
        return $this->getOr404($id);
    }

    protected function getOr404($id)
    {
        /** @var PageHandler $pagerepository */
        $pagerepository = $this->container->get('acme_blog.page.handler');

        /** @var Page $page */
        $page = $pagerepository->get($id);

        if (!$page) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $page;
    }
}