<?php

namespace Gites\GitesBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gites\GitesBundle\Entity\Media;
use Gites\GitesBundle\Form\contactType;


/**
 * Gites controller.
 *
 */
class GitesController extends Controller
{

    /**
     * homepage gites
     *
     */
    public function indexAction()
    {

        return $this->render('GitesBundle:Default:Gites/layout/index.html.twig');
    }



    /**
     * liste nav gites
     *
     */
    public function listeGitesNavAction()
    {
        $em = $this->getDoctrine()->getManager();
        $gites = $em->getRepository('GitesBundle:Gites')->findAll();

        return $this->render('GitesBundle:Default:Gites/modulesUsed/listeGitesNav.html.twig', array(
            'gites' => $gites,
        ));
    }
    /**
     * liste nav gites
     *
     */
    public function detailAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $gite = $em->getRepository('GitesBundle:Gites')->findOneBySlug($slug);
        $photos = $em->getRepository('GitesBundle:Media')->findByGite($gite->getId());

        return $this->render('GitesBundle:Default:Gites/layout/detail.html.twig', array(
            'gite' => $gite,
            'slides'=>$photos
        ));
    }
    /**
     * liste nav gites
     *
     */
    public function PastillesGitesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $gites = $em->getRepository('GitesBundle:Gites')->findAll();

        return $this->render('GitesBundle:Default:Gites/modulesUsed/PastillesGites.html.twig', array(
            'gites' => $gites,
        ));
    }

    /**
     * form de contact
     *
     */
    public function contactAction()
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new contactType($em));

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                // Perform some action, such as sending an email
                $contact =  $form->getData();
               // echo $contact['contenu'];
                // envoi du mail qui dit que la commande est bein payé

                $message = \Swift_Message::newInstance()
                    ->setSubject('Nouveau contact sur gites-galte.fr')
                    ->setFrom(array($contact['email']=>$contact['nom'].' '.$contact['prenom']))
                    ->setTo($this->container->getParameter('mailer_user'))
                    ->setCharset('utf-8')
                    ->setContentType('text/html')
                    ->setBody($contact['contenu'].'<br>'.$contact['telephone']);
                    //->setBody($this->renderView('GitesBundle:Default:emails/validationCommande.html.twig',array('utilisateur'=>$commande->getUtilisateur())));


                $this->get('mailer')->send($message);


                // fin d mail
                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page

                $this->get('session')->getFlashBag()->add('success','<strong>Votre message a bien été envoyé !</strong><br> Nous y répondrons dans les plus brefs délais.<br> Merci pour votre confiance,<br> M et Mme Galté');
                return $this->redirect($this->generateUrl('home'));
            }
        }

        return $this->render('GitesBundle:Default:Gites/layout/contact.html.twig', array(
            'form' => $form->createView()
        ));


    }


}
