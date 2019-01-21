<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Personnal;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends AbstractController
{
    /**
     * @Route("/home/search-personnal", name="admin_search")
     */
    public function searchPersonnal(EntityManagerInterface $em): Response
    {
        $db = $em->getRepository(Personnal::class);
        $personnals = $db->findAll();
        return $this->render('main/admin/search.html.twig', [
            'personnals' => $personnals,
        ]);
    }

    public function redirectPersonnal(Request $request): Response
    {
        $personnal = $request->get("personnal");
        return $this->redirectToRoute("personnal_show", ["id" => $personnal]);
    }
}
