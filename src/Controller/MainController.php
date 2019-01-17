<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class MainController extends AbstractController
{

    /**
     *
     * @Route("/home", name="main_index")
     */
    public function index()
    {
        if (is_null($user = $this->getUser())) {
            return $this->redirectToRoute("security_login");
        }
        if (is_null($user->getRole())) {
            return $this->redirectToRoute("security_logout");
        }

        $role = $user->getRole()->getName();
        if ('MEDECIN' === $role) {
            return $this->render('main/doctor.html.twig');
        } elseif ('SECRETAIRE' === $role) {
            return $this->render('main/secretary.html.twig');
        } elseif ('LABORATOIRE' === $role) {
            return $this->render('main/laboratory.html.twig');
        } elseif ('DATA_ADMIN' === $role) {
            return $this->render('main/admin.html.twig');
        } elseif ('INFIRMIERE' === $role) {
            return $this->render('main/nurse.html.twig');
        }

        throw new AccessDeniedHttpException();
    }
}
