<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Form\ExamType;
use App\Repository\ExamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author remyb
 * @Route("/exam")
 */
class ExamController extends AbstractController
{
    /**
     * @Route("/", name="exam_index", methods={"GET"})
     * @param ExamRepository $examRepository
     * @return Response
     */
    public function index(ExamRepository $examRepository): Response
    {
        return $this->render('exam/index.html.twig', ['exams' => $examRepository->findAll()]);
    }

    /**
     * @Route("/new", name="exam_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $exam = new Exam();
        $form = $this->createForm(ExamType::class, $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($exam);
            $entityManager->flush();
            
            $this->addFlash("success", "Demande effectuer avec succes");

            return $this->redirectToRoute('main_index');
        }

        return $this->render('exam/new.html.twig', [
            'exam' => $exam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exam_show", methods={"GET"})
     * @param Exam $exam
     * @return Response
     */
    public function show(Exam $exam): Response
    {
        return $this->render('exam/show.html.twig', ['exam' => $exam]);
    }

    /**
     * @Route("/{id}/edit", name="exam_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Exam $exam
     * @return Response
     */
    public function edit(Request $request, Exam $exam): Response
    {
        $form = $this->createForm(ExamType::class, $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('labo_new_index');
        }

        return $this->render('exam/edit.html.twig', [
            'exam' => $exam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exam_delete", methods={"DELETE"})
     * @param Request $request
     * @param Exam $exam
     * @return Response
     */
    public function delete(Request $request, Exam $exam): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exam->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($exam);
            $entityManager->flush();
        }

        return $this->redirectToRoute('exam_index');
    }
}
