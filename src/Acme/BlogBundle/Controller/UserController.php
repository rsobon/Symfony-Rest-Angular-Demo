<?php

namespace Acme\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{

    public function getSaltAction($username)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->findUserByUsername($username);
        if ( is_null($user) )
        {
            throw new HttpException(400, "Error User Not Found");
        }

        return new JsonResponse(array('salt' => $user->getSalt()));
    }

}
