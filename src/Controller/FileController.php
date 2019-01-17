<?php

namespace App\Controller;

use App\Entity\File;
use App\Form\FileUploadType;
use App\Repository\FileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/file")
 */
class FileController extends AbstractController
{
    /**
     * @Route("/", name="file_index", methods={"GET"})
     */
    public function index(FileRepository $fileRepository): Response
    {
        return $this->render('file/index.html.twig', ['files' => $fileRepository->findAll()]);
    }

    /**
     * @Route("/new", name="file_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $file = new File();
        $form = $this->createForm(FileUploadType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($file);
            $entityManager->flush();

            return $this->redirectToRoute('acts_show', ['id' => $file->getAct()->getId()]);
            
            return $this->redirectToRoute('file_index');
        }

        return $this->render('file/new.html.twig', [
            'file' => $file,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="file_show", methods={"GET"})
     */
    public function show(File $file): Response
    {
        return $this->render('file/show.html.twig', ['file' => $file]);
    }

    /**
     * @Route("/{id}/edit", name="file_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, File $file): Response
    {
        $form = $this->createForm(FileUploadType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('acts_show', ['id' => $file->getAct()->getId()]);
            return $this->redirectToRoute('file_index', ['id' => $file->getId()]);
        }

        return $this->render('file/edit.html.twig', [
            'file' => $file,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="file_delete", methods={"DELETE"})
     */
    public function delete(Request $request, File $file): Response
    {
        if ($this->isCsrfTokenValid('delete'.$file->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($file);
            $entityManager->flush();
        }

        return $this->redirectToRoute('acts_show', ['id' => $file->getAct()->getId()]);
        return $this->redirectToRoute('file_index');
    }
}
