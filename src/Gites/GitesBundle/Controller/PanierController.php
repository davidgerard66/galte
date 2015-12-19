<?php

namespace Gites\GitesBundle\Controller;

use Gites\GitesBundle\Entity\UtilisateursAdresses;
use Gites\GitesBundle\Entity\Commandes;
use Gites\GitesBundle\Form\UtilisateursAdressesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;


class PanierController extends Controller
{

    public function menuAction()
    {
        $session= $this->getRequest()->getSession();
        if (!$session->has('panier')){

            $article = 0;
        } else {
            $article = count($session->get('panier'));
        }
        return $this->render('GitesBundle:Default:panier/modulesUsed/panier.html.twig', array('article'=>$article));

    }
    public function supprimerAction($id)
    {
        $session= $this->getRequest()->getSession();
        $panier = $session->get('panier');

        if(array_key_exists($id,$panier)) {
            unset($panier[$id]);
            $session->set('panier',$panier);

            $this->get('session')->getFlashBag()->add('success','Article supprimé avec succés');
        }


        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('GitesBundle:Produits')->findArray(array_keys($panier));
        return $this->render('GitesBundle:Default:panier/layout/panier.html.twig', array('produits' => $produits,
            'panier'   => $panier));
    }

    public function ajouterAction($id)
    {
        $session= $this->getRequest()->getSession();
        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');
        //$panier[id du panier]=> qté du produit
        //var_dump($id);die();
        if(array_key_exists($id,$panier)) {
            if ($this->getRequest()->query->get('qte') != null) $panier[$id] = intval($this->getRequest()->query->get('qte'));
            $this->get('session')->getFlashBag()->add('success','Quantité modifié avec succés');
        } else {

            if ($this->getRequest()->query->get('qte') != null)
                $panier[$id]= intval( $this->getRequest()->query->get('qte'));
            else
                $panier[$id] = 1;

            $this->get('session')->getFlashBag()->add('success','Article ajouté avec succés');
        }

        $session->set('panier',$panier);
        return $this->redirect($this->generateUrl('panier'));
    }


    public function panierAction()
    {
        $session= $this->getRequest()->getSession();
       //$session->remove('panier');  //détruire une session
        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');
        //var_dump($panier);
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('GitesBundle:Produits')->findArray(array_keys($panier));
        return $this->render('GitesBundle:Default:panier/layout/panier.html.twig', array('produits' => $produits,
                                                                                             'panier'   => $panier));
    }
    public function adresseSuppressionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('GitesBundle:UtilisateursAdresses')->find($id);

        if ($this->container->get('security.context')->getToken()->getUser() != $entity->getUtilisateur() || !$entity )
            return $this->redirect($this->generateUrl('livraison'));

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('livraison'));

    }

    public function livraisonAction()
    {
        $em = $this->getDoctrine()->getManager();

        $utilisateur = $this->container->get('security.context')->getToken()->getUser();

        $entity = new UtilisateursAdresses();
        $form = $this->createForm(new UtilisateursAdressesType($em), $entity);

        if ($this->get('request')->getMethod()=="POST") {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $entity->setUtilisateur($utilisateur);
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('livraison'));
            }
            //$form->bind($this->get('request'));



        }

        return $this->render('GitesBundle:Default:panier/layout/livraison.html.twig', array('utilisateur'=>$utilisateur,'form'=> $form->createView()));
    }

    public function setLivraisonOnSession()
    {
        $session= $this->getRequest()->getSession();
        if (!$session->has('adresse')) $session->set('adresse',array());

        $adresse = $session->get('adresse');

        if ($this->getRequest()->request->get('livraison') !=null && $this->getRequest()->request->get('livraison')!=null)
        {
            $adresse['livraison'] = $this->getRequest()->request->get('livraison');
            $adresse['facturation'] = $this->getRequest()->request->get('facturation');
        }
        else {
            return $this->redirect($this->generateUrl('validation'));
        }

        $session->set('adresse',$adresse);
        return $this->redirect($this->generateUrl('validation'));

    }
    public function validationAction()
    {
        if ($this->get('request')->getMethod()=='POST')
            $this->setLivraisonOnSession();

        $em = $this->getDoctrine()->getManager();
       $prepareCommande = $this ->forward('GitesBundle:Commandes:prepareCommande');
        $commande = $em->getRepository('GitesBundle:Commandes')->find($prepareCommande->getContent());
       /*
        $session= $this->getRequest()->getSession();
        $adresse = $session->get('adresse');
        $panier = $session->get('panier');
        $produits = $em->getRepository('GitesBundle:Produits')->findArray(array_keys($panier));
        $livraison = $em->getRepository('GitesBundle:UtilisateursAdresses')->find($adresse['livraison']);
        $facturation = $em->getRepository('GitesBundle:UtilisateursAdresses')->find($adresse['facturation']);
*/
        return $this->render('GitesBundle:Default:panier/layout/validation.html.twig', array('commande'=>$commande ));

    }
}
