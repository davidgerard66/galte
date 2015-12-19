<?php

namespace Gites\GitesBundle\Controller;

use Gites\GitesBundle\Form\rechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gites\GitesBundle\Entity\Categories;

class ProduitsController extends Controller
{

   /* public function categorieAction($categorie)
    {

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('GitesBundle:Produits')->byCategorie($categorie);
        $categorie = $em->getRepository('GitesBundle:Categories')->find($categorie);
        if (!$categorie) throw $this->createNotFoundException('la categorie n\'existe pas');

        $session = $this->getRequest()->getSession();
        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier=false;

        return $this->render('GitesBundle:Default:produits/layout/produits.html.twig', array('produits'=>$produits, 'panier'=>$panier));
    }*/


    public function produitsAction(Categories $categorie = null)
    {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();

        if($categorie != null)
            $findProduits = $em->getRepository('GitesBundle:Produits')->byCategorie($categorie);
        else
            $findProduits = $em->getRepository('GitesBundle:Produits')->findBy(array('disponible'=>1));


        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier=false;

        //pagination
        $produits  = $this->get('knp_paginator')->paginate($findProduits,
            $this->get('request')->query->get('page', 1)/*page number*/,
            2/*limit per page*/
        );

       // $produits = $em->getRepository('GitesBundle:Produits')->findAll();

        return $this->render('GitesBundle:Default:produits/layout/produits.html.twig', array('produits'=>$produits, 'panier'=>$panier));

    }

    public function presentationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('GitesBundle:Produits')->find($id);

        $session = $this->getRequest()->getSession();
        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier=false;

        if (!$produit) throw $this->createNotFoundException('le produit n\'existe pas');
        return $this->render('GitesBundle:Default:produits/layout/presentation.html.twig', array('produit'=>$produit,'panier'=>$panier));
    }

    public function rechercheAction()
    {
        $form = $this->createForm(new rechercheType());
        return $this->render('GitesBundle:Default:Recherche/modulesUsed/recherche.html.twig', array('form'=>$form->createView()));
    }
    public function rechercheTraitementAction()
    {
        $form = $this->createForm(new rechercheType());

        if ($this->get('request')->getMethod()=='POST') {

            $form->bind($this->get('request'));

            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository('GitesBundle:Produits')->recherche($form['recherche']->getdata());
    }  else  {
           throw $this->createNotFoundException('la page nest pas autorise sans recherche');
        }



        return $this->render('GitesBundle:Default:produits/layout/produits.html.twig', array('produits'=>$produits));
    }
}
