<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Form\MedecinType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MedecinController extends AbstractController
{
    /**
     * @Route("/medecin", name="medecin")
     */
    public function index(): Response
    {
        return $this->render('medecin/index.html.twig', [
            'controller_name' => 'MedecinController',
        ]);
    }
    /**
     * @Route("/getMedecins", name="getMedecins")
     */
    public function getMedecins()
    {
        $em = $this->getDoctrine()->getRepository(Medecin::class)->findAll();
        // $s = $em->getRepository(StudentRepository::class);
        return $this->render('medecin/list.html.twig', [
            'data' => $em,
        ]);
    }

    /**
     * @Route("/addMedecin", name="addMedecin")
     */
    public function addStudent(Request $request)
    {
        $medecin = new Medecin();
        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            //prepare
            $em->persist($medecin);
            //execute
            $em->flush();
            //redirection vers la liste
            return $this->redirectToRoute('getMedecins');

            //echo 'insert in DataBase';
            //die;
        }

        return $this->render('student/addS.html.twig', [
            //elle est obligatoir de creer une view
            'f' => $form->createView(),
        ]);
    }
    /**
     * @Route("/deleteMedecin/{id}", name="deleteMedecin")
     */
    public function deleteMedecin(Request $request, $id)
    {
        $medecin = $this->getDoctrine()
            ->getRepository(Medecin::class)
            ->find($id);
        //var_dump($student);
        //die;
        $em = $this->getDoctrine()
            ->getManager();
        $em->remove($medecin);
        //execute query
        $em->flush();
        return $this->redirectToRoute('getMedecins');
    }
    /**
     * @Route("/updateMedecin/{id}", name="updateMedecin")
     */
    public function updateMedecin(Request $request, $id)
    {
        $medecin = $this->getDoctrine()
            ->getRepository(Medecin::class)
            ->find($id);
        $form = $this->createForm(MedecinType::class, $medecin);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('getMedecins');
        }

        return $this->render('medecin/add.html.twig', [
            //elle est obligatoir de creer une view
            'f' => $form->createView(),
        ]);
    }
    
}
