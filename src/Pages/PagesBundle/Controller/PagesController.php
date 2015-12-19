<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('PagesBundle:Pages')->findAll();

        return $this->render('PagesBundle:Default:pages/modulesUsed/menu.html.twig',array('pages'=>$pages));
    }

    public function pageAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('PagesBundle:Pages')->findOneBy(array('slug'=>$slug)); // ou findonebyslug

        if (!$page) throw $this->createNotFoundException('la page n\'�xiste pas');

        return $this->render('PagesBundle:Default:pages/layout/pages.html.twig',array('page'=>$page) );
    }
}
