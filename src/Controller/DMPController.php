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
 * @Route("/dmp")
 */
class DMPController extends AbstractController
{
    /**
     * @Route("/", name="dmp_index", methods={"GET"})
     */
    public function index(DMPRepository $DMPRepository): Response
    {
        return $this->render('dmp/index.html.twig', ['DMPs' => $DMPRepository->findAll()]);
    }

    /**
     * @Route("/new", name="dmp_new", methods={"GET","POST"})
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

            return $this->redirectToRoute('dmp_index');
        }

        return $this->render('dmp/new.html.twig', [
            'dmp' => $DMP,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dmp_show", methods={"GET"})
     */
    public function show(DMP $DMP): Response
    {
        return $this->render('dmp/show.html.twig', ['dmp' => $DMP]);
    }

    /**
     * @Route("/{id}/edit", name="dmp_edit", methods={"GET","POST"})
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
}
