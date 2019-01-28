<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Exam;
use Symfony\Component\HttpFoundation\Request;

class LaboController extends AbstractController
{
    /**
     * @Route("/home/exam-new", name="labo_new_exam")
     */
    public function getNewExam(EntityManagerInterface $em): Response
    {
        $db = $em->getRepository(Exam::class);
        $exams = $db->getUnfinishedExam();
        return $this->render("main/labo/exam.html.twig", [
            'exams' => $exams,
        ]);
    }
    
    /**
     * @Route("home/exam-old", name="doctor_search")
     */
     public function searchDMP(EntityManagerInterface $em): Response  
    {
        $db = $em->getRepository(Exam::class);
        $exams = $db->getFinishedExam();
        return $this->render("main/labo/exam.html.twig", [
            'exams' => $exams,
        ]);
    }
    
    /**
     * @Route("home/search/request", name="doctor_dmp_show")
     */
    public function redirectDMP(Request $request): Response
    {
        $dmp = $request->get("dmp");
        return $this->redirectToRoute("dmp_show", ["id" => $dmp]);
    }
}
