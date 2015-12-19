<?php

namespace Gites\GitesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class testType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // ici nous allons faire notre formualire php
        // le html c fini
        $builder
            ->add('email','email',array('required'=>false))
            ->add('nom')
            ->add('prenom')
            ->add('sexe','choice',array('choices'=> array(
                                                            '0'=>'homme',
                                                            '1'=>'femme',
                                                            '2'=>'autres'
                                                        ),
                                        'expanded'=>false,
                                        'preferred_choices'=>array(
                                                            '0','1'
                                                                   )
                                        ))
            ->add('contenu')
            ->add('date','datetime')
            ->add('pays','country')
            ->add('utilisateurs','entity',array('class'=>'Utilisateurs\UtilisateursBundle\Entity\Utilisateurs'))
            ->add('envoyer','submit');
             }

    public function getName()
    {
        return 'Gites_Gitesbundle_test';
    }
}