<?php

namespace Acme\BlogBundle\Repository;

/**
 * Created by PhpStorm.
 * User: R
 * Date: 2015-09-28
 * Time: 16:47
 */
interface IPageHandler
{
    /**
     * Get a Page given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return IPageHandler
     */
    public function get($id);
}