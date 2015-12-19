<?php
namespace Gites\GitesBundle\Services;


use Symfony\Component\Security\Core\SecurityContextInterface;


class getReference
{
        public function __construct($securityContext, $entitymanager)
    {
                $this->securityContext = $securityContext;
                $this->em = $entitymanager;

            }

    public function reference()
    {
                $reference = $this->em->getRepository('GitesBundle:Commandes')->findOneBy(array('valider'=>1), array('id'=>'DESC'),1,1);
        if (!$reference)
            return 1;
        else
            return $reference->getReference() +1;
    }
} 