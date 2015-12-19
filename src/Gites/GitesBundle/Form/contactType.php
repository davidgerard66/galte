<?php

namespace Gites\GitesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManager;

class contactType extends AbstractType
{
    private $em;
    // Injecting EntityManager into YourType
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    private function getHebergementChoices()
    {

        $gites = $this->em->getRepository('GitesBundle:Gites')->findAll();
        $leschoix = array();

            foreach ($gites as $gite){
             $leschoix[$gite->getNom()] = $gite->getNom();
            }

            $leschoix['Tous les '.count($gites)]='Tous les '.count($gites);


        return $leschoix;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('email','email', array('label'=>'Votre e-mail'))
            ->add('nom',null,array('required'=>false,'label'=>'Nom'))
            ->add('prenom',null,array('required'=>false,'label'=>'Prénom'))
            ->add('telephone',null,array('required'=>false,'label'=>'Téléphone'))
            /*->add('Hebergement_concerne', 'entity', array(
                'class'    => 'GitesBundle:Gites',
                'property' => 'nom',
                'required' => true,
                'empty_value' => '-- Choissisez dans la liste  --',
                'label'    => 'Hébergement concerné  (Utilisez la touche control pour sélectionner plusieurs choix.)',
                'multiple' => true
            ))*/
            ->add('Hebergement_concerne', 'choice', array(
                'choices' => $this->getHebergementChoices(),
                'multiple' => true,
                'label'    => 'Hébergement concerné  (Utilisez la touche control pour sélectionner plusieurs choix.)',
                ))
            ->add('date_debut', 'date', array(
                 'label'    => 'Date début de séjour souhaitée',
            ))
            ->add('date_fin', 'date', array(
                'label'    => 'Date de fin de séjour',
            ))
            ->add('contenu','textarea',array('label'=>'Votre message'))
            ->add('envoyer','submit',array('label'=>'Envoyer','attr'=> array('class'=>'btn btn-success')));
             }

    public function getName()
    {
        return 'Gites_Gitesbundle_contact';
    }
}