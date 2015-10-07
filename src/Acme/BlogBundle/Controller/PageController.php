<?php
/**
 * Created by PhpStorm.
 * User: R
 * Date: 2015-09-28
 * Time: 16:29
 */

namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\Form\PageType;
use Acme\BlogBundle\Repository\PageHandler;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Acme\BlogBundle\Entity\Page;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Annotations\View(templateVar="page")
     * @param int $id the page id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function editPageAction($id)
    {
        /** @var PageHandler $pageRepository */
        $pageRepository = $this->container->get('acme_blog.page.handler');

        /** @var Page $page */
        $page = $pageRepository->get($id);

        if (!$page) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }

        $form = $this->createForm(new PageType(), $page);

        $view = $this->view($form, 200)
            ->setTemplate('AcmeBlogBundle:Page:editPage.html.twig')
            ->setTemplateVar('form')
        ;

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @param int $id the page id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postPageAction(Request $request, $id)
    {
        /** @var PageHandler $pageRepository */
        $pageRepository = $this->container->get('acme_blog.page.handler');

        /** @var Page $page */
        $page = $pageRepository->get($id);

        if (!$page) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }

        $form = $this->createForm(new PageType(), $page);

        $form->submit($request);
        if ($form->isValid()) {
            $pageRepository->post($page);
            $view = $this->routeRedirectView('api_1_get_page', ['id' => $page->getId()])
            ;
        } else {
            $view = $this->view(['form' => $form], 400);
        }

        return $this->handleView($view);
    }
}