<?php

namespace App\Controller;

use App\Entity\DMP;
use App\Form\DMPType;
use App\Repository\DMPRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author remyb
 * @Route("/dmp")
 */
class DMPController extends AbstractController
{

    /**
     * @Route("/", name="dmp_index", methods={"GET"})
     * @param DMPRepository $DMPRepository
     * @return Response
     */
    public function index(DMPRepository $DMPRepository): Response
    {
        return $this->render('dmp/index.html.twig', ['DMPs' => $DMPRepository->findAll()]);
    }

    /**
     * @Route("/new", name="dmp_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $DMP = new DMP();
        $form = $this->createForm(DMPType::class, $DMP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($DMP);
            $entityManager->flush();

            return $this->redirectToRoute('dmp_show', ['id' => $DMP->getId()]);
        }

        return $this->render('dmp/new.html.twig', [
            'dmp' => $DMP,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dmp_show", methods={"GET"})
     * @param DMP $DMP
     * @return Response
     */
    public function show(DMP $DMP): Response
    {
        return $this->render('dmp/show.html.twig', ['dmp' => $DMP]);
    }

    /**
     * @Route("/{id}/edit", name="dmp_edit", methods={"GET","POST"})
     * @param Request $request
     * @param DMP $DMP
     * @return Response
     */
    public function edit(Request $request, DMP $DMP): Response
    {
        $form = $this->createForm(DMPType::class, $DMP);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute("dmp_show", ['id' => $DMP->getId()]);

            return $this->redirectToRoute('dmp_index', ['id' => $DMP->getId()]);
        }

        return $this->render('dmp/edit.html.twig', [
            'dmp' => $DMP,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dmp_delete", methods={"DELETE"})
     * @param Request $request
     * @param DMP $DMP
     * @return Response
     */
    public function delete(Request $request, DMP $DMP): Response
    {
        if ($this->isCsrfTokenValid('delete'.$DMP->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($DMP);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dmp_index');
    }
    
    /**
     * Return all exams rattach to a specific dmp
     * @Route("/{id}/examens", name="dmp_exams", methods={"GET"})
     * @param DMP $DMP
     * @return Response
     */
    public function getExams(DMP $DMP): Response
    {
        $exams = $DMP->getExams();
        return $this->render("dmp/exam.html.twig", [
            "dmp" => $DMP,
            "exams" => $exams,
        ]);
    }
    
    /**
     * Return all acts related to a specific dmp
     * @Route("/{id}/actes", name="dmp_acts", methods={"GET"})
     * @param DMP $DMP
     * @return Response
     */
    public function getActs(DMP $DMP): Response
    {
        $acts = $DMP->getActs();
        return $this->render("dmp/acts.html.twig", [
            "dmp" => $DMP,
            "acts" => $acts,
        ]);
    }
}
