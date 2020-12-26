<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant", name="etudiant")
     */
    public function index(): Response
    {
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }

    /**
     * @Route("/addetudiant", name="addetudiant")
     */
    public function addetudiant(Request $request): Response
    {
        $etudiant = new Etudiant();
        //$etudiant->setName('khaled');
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();
            return $this->redirectToRoute('getEtudiant');
            
        }
        return $this->render('etudiant/add.html.twig', [
            'f' => $form->createView(),
        ]);
    }

    /**
     * @Route("/getEtudiant", name="getEtudiant")
     */
    public function getStudent(EtudiantRepository $repository): Response
    {
       $result = $repository->findAll();
        return $this->render('etudiant/list.html.twig', [
            'f' => $result,
        ]);
    }

    /**
     * @Route("/deleteEtudiant", name="deleteEtudiant")
     */
    public function deleteEtudiant(Request $request): Response
    {
        $etudiant = new Etudiant();
        //$etudiant->setName('khaled');
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();
            return $this->redirectToRoute('getEtudiant');
            
        }
        return $this->render('etudiant/add.html.twig', [
            'f' => $form->createView(),
        ]);
    }

}
