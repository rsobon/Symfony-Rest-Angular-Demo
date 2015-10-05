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
use FOS\RestBundle\Controller\Annotations;
use Acme\BlogBundle\Entity\Page;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends FOSRestController
{

    /**
     * @Annotations\View(templateVar="pages")
     *
     * @return Page
     */
    public function getPagesAction()
    {
        /** @var PageHandler $pageRepository */
        $pageRepository = $this->container->get('acme_blog.page.handler');

        /** @var array $pages */
        $pages = $pageRepository->getAll();

        if (!$pages) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }

        return $pages;
    }

    /**
     * @Annotations\View(templateVar="page")
     *
     * @param $id
     * @return Page
     */
    public function getPageAction($id)
    {
        /** @var PageHandler $pageRepository */
        $pageRepository = $this->container->get('acme_blog.page.handler');

        /** @var Page $page */
        $page = $pageRepository->get($id);

        if (!$page) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }

        return $page;
    }
}