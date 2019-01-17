<?php

namespace App\Controller;

use App\Entity\Acts;
use App\Form\ActsType;
use App\Repository\ActsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/acts")
 */
class ActsController extends AbstractController
{
    /**
     * @Route("/", name="acts_index", methods={"GET"})
     */
    public function index(ActsRepository $actsRepository): Response
    {
        return $this->render('acts/index.html.twig', ['acts' => $actsRepository->findAll()]);
    }

    /**
     * @Route("/new", name="acts_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $act = new Acts();
        $form = $this->createForm(ActsType::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $act->setDateCreation(new \DateTime());
            $act->setAuthor($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($act);
            $entityManager->flush();
            
            return $this->redirectToRoute("doctor_acts");

            return $this->redirectToRoute('acts_index');
        }

        return $this->render('acts/new.html.twig', [
            'act' => $act,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acts_show", methods={"GET"})
     */
    public function show(Acts $act): Response
    {
        return $this->render('acts/show.html.twig', ['act' => $act]);
    }

    /**
     * @Route("/{id}/edit", name="acts_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Acts $act): Response
    {
        $form = $this->createForm(ActsType::class, $act);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('doctor_acts');
            return $this->redirectToRoute('acts_index', ['id' => $act->getId()]);
        }

        return $this->render('acts/edit.html.twig', [
            'act' => $act,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acts_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Acts $act): Response
    {
        if ($this->isCsrfTokenValid('delete'.$act->getId(), $request->request->get('_token')) || 1 === 1) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($act);
            $entityManager->flush();
        }
        
        return $this->redirectToRoute("doctor_acts");

        return $this->redirectToRoute('acts_index');
    }
}
