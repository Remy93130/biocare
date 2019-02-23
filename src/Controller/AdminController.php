<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Personnal;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Manage admin action avalaible
 * @author remyb
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/home/search-personnal", name="admin_search")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function searchPersonnal(EntityManagerInterface $em): Response
    {
        $db = $em->getRepository(Personnal::class);
        $personnals = $db->findAll();
        return $this->render('main/admin/search.html.twig', [
            'personnals' => $personnals,
        ]);
    }

    /**
     * @Route("/home/search-personnal/request", name="admin_personnal_show")
     * @param Request $request
     * @return Response
     */
    public function redirectPersonnal(Request $request): Response
    {
        $personnal = $request->get("personnal");
        return $this->redirectToRoute("personnal_show", ["id" => $personnal]);
    }
}
