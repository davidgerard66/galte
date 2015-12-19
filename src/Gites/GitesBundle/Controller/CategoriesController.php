<?php

namespace Gites\GitesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{

    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('GitesBundle:Categories')->findAll();

        return $this->render('GitesBundle:Default:Categories/modulesUsed/menu.html.twig', array('categories' => $categories));
    }

}