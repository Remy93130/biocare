<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Acts;

class DoctorController extends AbstractController
{
    /**
     * @Route("/home/acts", name="doctor_acts")
     */
    public function getActs(EntityManagerInterface $em): Response {
        $db = $em->getRepository(Acts::class);
        $acts = $db->getDoctorUnifinishedActs($this->getUser()->getId());
        return $this->render("main/doctor/search.html.twig", [
            'acts' => $acts,
        ]);
    }
}

