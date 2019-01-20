<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\DMP;
use Symfony\Component\HttpFoundation\Request;

class SecretaryController extends AbstractController
{
    /**
     * @Route("home/update", name="secretary_search")
     */
    public function searchDMP(EntityManagerInterface $em): Response
    {
        $db = $em->getRepository(DMP::class);
        $DMPs = $db->findAll();
        return $this->render("main/secretary/search.html.twig", [
            "dmps" => $DMPs,
        ]);
    }

    /**
     * @Route("home/update/request", name="secretary_dmp_edit")
     */
    public function redirectDMP(Request $request): Response
    {
        $dmp = $request->get("dmp");
        return $this->redirectToRoute("dmp_edit", ["id" => $dmp]);
    }
}