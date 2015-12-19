<?php

namespace Gites\GitesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Gites\GitesBundle\Entity\Media;


/**
 * Slides controller.
 *
 */
class SlidesController extends Controller
{



    /**
     * slide carousel pour bootstrtap
     *
     */
    public function CarouselAction()
    {
        $em = $this->getDoctrine()->getManager();
        $slides = $em->getRepository('GitesBundle:Slides')->myfindAllVisible('Slide');

        return $this->render('GitesBundle:Default:Slides/modulesUsed/Carousel.html.twig', array(
            'slides' => $slides,
        ));
    }
    /**
     * slide carousel pour bootstrtap
     *
     */
    public function showNewsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository('GitesBundle:Slides')->myfindAllVisible('News');

        return $this->render('GitesBundle:Default:Slides/modulesUsed/showNews.html.twig', array(
            'news' => $news
        ));
    }



}
