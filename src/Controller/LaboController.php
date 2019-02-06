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
            'type' => "new",
            'exams' => $exams
        ]);
    }

    /**
     * @Route("home/exam-old", name="labo_old_exam")
     */
    public function getOldExam(EntityManagerInterface $em): Response
    {
        $db = $em->getRepository(Exam::class);
        $exams = $db->getFinishedExam();
        return $this->render("main/labo/exam.html.twig", [
            'type' => "old",
            'exams' => $exams
        ]);
    }

    /**
     * @Route("home/search/exam", name="labo_exam_show")
     */
    public function redirectExam(Request $request): Response
    {
        $exam = $request->get("exam");
        return $this->redirectToRoute("exam_show", [
            "id" => $exam
        ]);
    }
}
