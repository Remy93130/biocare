<?php

namespace App\Controller;

use App\Entity\Personnal;
use App\Form\PersonnalType;
use App\Repository\PersonnalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/personnal")
 */
class PersonnalController extends AbstractController
{
    /**
     * @Route("/", name="personnal_index", methods={"GET"})
     */
    public function index(PersonnalRepository $personnalRepository): Response
    {
        return $this->render('personnal/index.html.twig', ['personnals' => $personnalRepository->findAll()]);
    }

    /**
     * @Route("/new", name="personnal_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $personnal = new Personnal();
        $form = $this->createForm(PersonnalType::class, $personnal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $personnal->getPassword() != null) {
            $pwd = $personnal->getPassword();
            $personnal->setPassword($encoder->encodePassword($personnal, $pwd));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personnal);
            $entityManager->flush();

            return $this->redirectToRoute('personnal_index');
        }

        return $this->render('personnal/new.html.twig', [
            'personnal' => $personnal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnal_show", methods={"GET"})
     */
    public function show(Personnal $personnal): Response
    {
        return $this->render('personnal/show.html.twig', ['personnal' => $personnal]);
    }

    /**
     * @Route("/{id}/edit", name="personnal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Personnal $personnal): Response
    {
        $form = $this->createForm(PersonnalType::class, $personnal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            if ($this->getUser()->getRole()->getName() == "DATA_ADMIN") {
                return $this->redirectToRoute(""); // @TODO: Get the route
            }

            $this->addFlash("success", "Votre profile a ete mis a jour.");

            return $this->redirectToRoute('main_index');
        }

        return $this->render('personnal/edit.html.twig', [
            'personnal' => $personnal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="personnal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Personnal $personnal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personnal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($personnal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('personnal_index');
    }
}
