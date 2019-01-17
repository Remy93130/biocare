<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="security_login")
     */
    public function login(AuthorizationCheckerInterface $authCheck, AuthenticationUtils $auth)
    {
        if (true == $authCheck->isGranted('ROLE_MEMBER')) {
            return $this->redirectToRoute('main_index');
        }
        $error = $auth->getLastAuthenticationError();
        $lastUsername = $auth->getLastUsername();
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
            'lastUsername' => $lastUsername,
            'error' => $error,
        ]);
    }
    
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {}
}
