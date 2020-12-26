<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="produit")
     */
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
    /**
     * @Route("/addProduit", name="addProduit")
     */
    public function addProduit(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            //prepare
            $em->persist($produit);
            //execute
            $em->flush();
            //redirection vers la liste
            //return $this->redirectToRoute('getProduit');

            //echo 'insert in DataBase';
            //die;
        }

        return $this->render('produit/addProduit.html.twig', [
            //elle est obligatoir de creer une view
            'f' => $form->createView(),
        ]);
    }
}
