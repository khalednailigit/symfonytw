<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StType;
use App\Repository\StudentRepository;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{

    /**
     * @Route("/getStudents", name="getStudents")
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

    /**
     * @Route("/addStudent", name="addStudent")
     */
    public function addStudent(Request $request)
    {
        $student = new Student();
        $form = $this->createForm(StType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            //prepare
            $em->persist($student);
            //execute
            $em->flush();
            //redirection vers la liste
            return $this->redirectToRoute('getStudents');

            //echo 'insert in DataBase';
            //die;
        }

        return $this->render('student/addS.html.twig', [
            //elle est obligatoir de creer une view
            'f' => $form->createView(),
        ]);
    }
    /**
     * @Route("/deleteStudent/{id}", name="deleteStudent")
     */
    public function deleteStudent(Request $request, $id)
    {
        $student = $this->getDoctrine()
            ->getRepository(Student::class)
            ->find($id);
        //var_dump($student);
        //die;
        $em = $this->getDoctrine()
            ->getManager();
        $em->remove($student);
        //execute query
        $em->flush();
        return $this->redirectToRoute('getStudents');
    }

    /**
     * @Route("/updateStudent/{id}", name="updateStudent")
     */
    public function updateStudent(Request $request, $id)
    {
        //$student = new Student();
        $student = $this->getDoctrine()
            ->getRepository(Student::class)
            ->find($id);
        $form = $this->createForm(StType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('getStudents');
        }

        return $this->render('student/updatestudent.html.twig', [
            //elle est obligatoir de creer une view
            'f' => $form->createView(),
        ]);
    }
}
