<?php

namespace Gites\GitesBundle\Controller;

use Gites\GitesBundle\Entity\UtilisateursAdresses;
use Gites\GitesBundle\Entity\Commandes;
use Gites\GitesBundle\Entity\Produits;
use Gites\GitesBundle\Form\UtilisateursAdressesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;


class CommandesController extends Controller
{
    public function  prepareCommandeAction()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();

        if (!$session->has('commande'))
            $commande = new Commandes();
        else
            $commande = $em->getRepository('GitesBundle:Commandes')->find($session->get('commande'));

        $commande -> setDate( new \DateTime());
        $commande -> setUtilisateur($this->container->get('security.context')->getToken()->getUser());
        $commande -> setValider(0);
        $commande -> setReference(0);
        $commande -> setCommande($this->facture());

        if (!$session->has('commande')){
            $em->persist($commande);
            $session->set('commande',$commande);
        }

        $em->flush();

        return new Response($commande->getId());

    }

    public function  facture()
    {
        $session = $this->getRequest()->getSession();
        $em = $this->getDoctrine()->getManager();
        $generator = $this->container->get('security.secure_random'); // genere une chaine aleatoire

        $adresse = $session->get('adresse');
        $panier = $session->get('panier');
        $commande = array();
        $totalHT  = 0;
        $totalTVA = 0;


        $facturation = $em->getRepository('GitesBundle:UtilisateursAdresses')->find($adresse['facturation']);
        $livraison = $em->getRepository('GitesBundle:UtilisateursAdresses')->find($adresse['facturation']);
        $produits = $em->getRepository('GitesBundle:Produits')->findArray(array_keys($panier));

        foreach ($produits as $produit)
        {
            $prixHT = ( $produit->getPrix() * $panier[$produit->getId()]);
            $prixTTC = $prixHT / $produit->getTva()->getMultiplicate();
            $totalHT += $prixHT;


            if (!isset($commande['tva']['%'.$produit->getTva()->getValeur()]))
                            $commande['tva']['%'.$produit->getTva()->getValeur()] =  round($prixTTC-$prixHT,2);

            else
                $commande['tva']['%' . $produit->getTva()->getValeur()] += round($prixTTC - $prixHT, 2);

            $totalTVA += round($prixTTC-$prixHT,2) ;


            $commande['produit'][$produit->getid()] = array('reference'=> $produit->getNom(),
                                                            'quantite'=> $panier[$produit->getId()],
                                                             'prixHT'=> round($produit->getPrix(),2),
                                                             'prixTTC'=> round(($produit->getPrix())/$produit->getTva()->getMultiplicate(),2)  );


        }

            $commande['livraison']=   array('prenom'=>$livraison->getPrenom(),
                                              'nom'=>$livraison->getNom(),
                                                 'telephone'=>$livraison->getTelephone(),
                                                 'adresse'=>$livraison->getAdresse(),
                                                 'cp'=>$livraison->getCp(),
                                                 'ville'=>$livraison->getVille(),
                                                 'pays'=>$livraison->getPays(),
                                                'complement'=>$livraison->getComplement(),
                                             );
            $commande['facturation']=   array('prenom'=>$facturation->getPrenom(),
                     'nom'=>$facturation->getNom(),
                     'telephone'=>$facturation->getTelephone(),
                     'adresse'=>$facturation->getAdresse(),
                     'cp'=>$facturation->getCp(),
                     'ville'=>$facturation->getVille(),
                     'pays'=>$facturation->getPays(),
                     'complement'=>$facturation->getComplement(),
                 );

            $commande['prixHT'] = round($totalHT,2);
            $commande['prixTTC'] = round($totalHT + $totalTVA,2);
            $commande['token'] = bin2hex($generator->nextBytes(20));


            return $commande;


    }

    /*
     *  cette methgode remplace l'api banque
     */
        public function  validationCommandeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository('GitesBundle:Commandes')->find($id);

        if (!$commande || $commande->getValider(1)==1)
            throw $this->createNotFoundException('la commande nexiste pas ou est deja valide');

        $commande->setValider(1);
        $commande->setReference($this->container->get('setNewReference')->reference()); //service

        $em->flush();

        $session = $this->getRequest()->getSession(); // commande valide, on supprime less essions
        $session->remove('panier');
        $session->remove('commande');
        $session->remove('adresse');

        // envoi du mail qui dit que la commande est bein payé

        $message = \Swift_Message::newInstance()
                        ->setSubject('Validation de la commande')
                        ->setFrom(array('editions.creatives@gmail.com'=>'david Gites'))
                        ->setTo($commande->getUtilisateur()->getEmailCanonical())
                        ->setCharset('utf-8')
                        ->setContentType('text/html')
                        ->setBody($this->renderView('GitesBundle:Default:emails/validationCommande.html.twig',array('utilisateur'=>$commande->getUtilisateur())));


        $this->get('mailer')->send($message);


        // fin d mail

        $this->get('session')->getFlashBag()->add('success','Votre commande est validé avec succes');
        return $this->redirect($this->generateUrl('factures'));

    }
}
