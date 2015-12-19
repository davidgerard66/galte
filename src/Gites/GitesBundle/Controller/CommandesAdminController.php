<?php

namespace Gites\GitesBundle\Controller;

use Gites\GitesBundle\Entity\UtilisateursAdresses;
use Gites\GitesBundle\Entity\Commandes;
use Gites\GitesBundle\Entity\Produits;
use Gites\GitesBundle\Form\UtilisateursAdressesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;


class CommandesAdminController extends Controller
{
   public function commandesAction()
   {

       $em = $this->getDoctrine()->getManager();
       $commandes = $em->getRepository('GitesBundle:Commandes')->findAll();
       return $this->render('GitesBundle:Administration:Commandes/layout/index.html.twig', array('commandes' => $commandes));

   }


    public function showFactureAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('GitesBundle:Commandes')->find($id);
        if (!$facture){
            $this->get('session')->getFlashBag()->add('error','pas de facture');
            return $this->generateUrl('adminCommandes');
        }

        $this->container->get('editeFacture')->facture($facture)->output('facture.pdf');

        $response = new Response();
        $response->headers->set('Content-type','application/pdf');
        return $response;






    }
}
