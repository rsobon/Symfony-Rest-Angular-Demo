<?php

namespace Acme\BlogBundle\Entity;

/**
 * Created by PhpStorm.
 * User: R
 * Date: 2015-09-28
 * Time: 16:46
 */
interface IPage
{
    /**
     * Set title
     *
     * @param string $title
     * @return IPage
     */
    public function setTitle($title);

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set body
     *
     * @param string $body
     * @return IPage
     */
    public function setBody($body);

    /**
     * Get body
     *
     * @return string
     */
    public function getBody();
}