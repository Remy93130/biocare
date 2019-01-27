<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\DMP;
use Symfony\Component\HttpFoundation\Request;

class NurseController extends AbstractController
{
    /**
     * @Route("home/insert", name="nurse_search")
     */
    public function searchDMP(EntityManagerInterface $em): Response
    {
        $db = $em->getRepository(DMP::class);
        $DMPs = $db->findAll();
        return $this->render("main/nurse/search.html.twig", [
            "dmps" => $DMPs,
        ]);
    }

    /**
     * @Route("home/insert/request", name="nurse_dmp_search")
     */
    public function redirectDMP(EntityManagerInterface $em, Request $request): Response
    {
        $db = $em->getRepository(DMP::class);
        $dmp = $db->find($request->get("dmp"));
        return $this->render("main/nurse/measures.html.twig", ["dmp" => $dmp]);
    }

    /**
     * @Route("home/insert/execute", name="nurse_add_measure")
     */
    public function insertMeasure(Request $request, EntityManagerInterface $em): Response
    {
        $db = $em->getRepository(DMP::class);
        $dmp = $db->find($request->get("dmp"));

        $old = $request->get("old_measures");
        $old .= "\n";

        $dmp->setMeasures($old.$request->get("new_measures"));
        $em->persist($dmp);
        $em->flush();

        $this->addFlash("success", "Les donnees on bien ete ajoutees.");
        return $this->redirectToRoute("nurse_search");
    }
}
