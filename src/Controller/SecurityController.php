<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="security_login")
     */
    public function login(AuthorizationCheckerInterface $authCheck)
    {
        if (true == $authCheck->isGranted('ROLE_MEMBER')) {
            return $this->redirectToRoute(''); // @TODO: create the route for the redirection
        }
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }
    
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {}
}
