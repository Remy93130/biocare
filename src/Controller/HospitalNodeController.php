<?php

namespace App\Controller;

use App\Entity\HospitalNode;
use App\Form\HospitalNodeType;
use App\Repository\HospitalNodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hospitalnode")
 */
class HospitalNodeController extends AbstractController
{
    /**
     * @Route("/", name="hospital_node_index", methods={"GET"})
     */
    public function index(HospitalNodeRepository $hospitalNodeRepository): Response
    {
        return $this->render('hospital_node/index.html.twig', ['hospital_nodes' => $hospitalNodeRepository->findAll()]);
    }

    /**
     * @Route("/new", name="hospital_node_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hospitalNode = new HospitalNode();
        $form = $this->createForm(HospitalNodeType::class, $hospitalNode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hospitalNode);
            $entityManager->flush();

            return $this->redirectToRoute('hospital_node_index');
        }

        return $this->render('hospital_node/new.html.twig', [
            'hospital_node' => $hospitalNode,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hospital_node_show", methods={"GET"})
     */
    public function show(HospitalNode $hospitalNode): Response
    {
        return $this->render('hospital_node/show.html.twig', ['hospital_node' => $hospitalNode]);
    }

    /**
     * @Route("/{id}/edit", name="hospital_node_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HospitalNode $hospitalNode): Response
    {
        $form = $this->createForm(HospitalNodeType::class, $hospitalNode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hospital_node_index', ['id' => $hospitalNode->getId()]);
        }

        return $this->render('hospital_node/edit.html.twig', [
            'hospital_node' => $hospitalNode,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hospital_node_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HospitalNode $hospitalNode): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hospitalNode->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hospitalNode);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hospital_node_index');
    }
}
