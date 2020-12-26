<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{

    /**
     * @Route("/student", name="student")
     */
    public function getStudents(StudentRepository $repo)
    {
        $em = $this->getDoctrine()->getRepository(Student::class)->findAll();
        // $s = $em->getRepository(StudentRepository::class);
        return $this->render('student/list.html.twig', [
            'data' => $em,
        ]);
    }
    /**
     * @Route("/getStudent/{id}", name="X")
     */
    public function getStudent($id)
    {
        $em = $this->getDoctrine()->getManager();
        $rs = $em->getRepository(Student::class)->find($id);
        var_dump($rs);
        die;
        // $s = $em->getRepository(StudentRepository::class);
        //return $this->render('student/list.html.twig', [
        //     'data' => $em,
        //]);
    }
}
