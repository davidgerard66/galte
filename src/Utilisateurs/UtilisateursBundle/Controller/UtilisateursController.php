<?php

namespace Utilisateurs\UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class UtilisateursController extends Controller
{
    public function renvoiVillesparCpAction(Request $request, $cp){


     if ($request->isXmlHttpRequest() || 1==1) {


         $em = $this->getDoctrine()->getManager();
         $villeCp = $em->getRepository('UtilisateursBundle:Villes')->findBy(array('villeCodePostal' => $cp));


         if ($villeCp) {
             $villes = array();
             foreach ($villeCp as $ville)
                 $villes[$ville->getVilleNom()] = $ville->getVilleNom();
         } else {
             $villes = null;

         }

         $response = new JsonResponse; // sert a retourner automatiquement du json en $response

         return $response->setData(array('villes' => $villes));
     }
        else{
            throw new \Exception('cette page n\'est pas appelable directement');
        }

    }

    public function facturesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $factures = $em->getRepository('GitesBundle:Commandes')->byFacture($this->getUser());

        return $this->render('UtilisateursBundle:Default:layout/facture.html.twig', array('factures' => $factures));
    }

    public function facturePDFAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('GitesBundle:Commandes')->findOneBy(array('utilisateur'=>$this->getUser(),
                                                                                      'valider'=>1,
                                                                                      'id'=>$id));
        if (!$facture){
            $this->get('session')->getFlashBag()->add('error','pas de facture');
            return $this->generateUrl('factures');
        }



        $this->container->get('editeFacture')->facture($facture)->output('facture.pdf');

        $response = new Response();
        $response->headers->set('Content-type','application/pdf');
        return $response;


      /*  $response = new Response(
            $html2pdf->Output(),
            Response::HTTP_OK,
            array('content-type' => 'application/pdf')
        );
*/
       /* $d = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'facture.pdf'
        );

        $response->headers->set('Content-Disposition', $d);
*/

    }
}
