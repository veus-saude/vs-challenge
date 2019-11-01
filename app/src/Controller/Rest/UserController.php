<?php

namespace App\Controller\Rest;

use App\Entity\User;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Rest\RouteResource("User")
 */

class UserController extends AbstractFOSRestController
{

    /**
     * @param User
     *
     * @return View
     */
    public function getAction(User $user): View
    {
        return new View([$user], Response::HTTP_OK);
    }

    /**
    * @return View
    */
    public function cgetAction(): View
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return new View($users, Response::HTTP_OK);
    }

}
