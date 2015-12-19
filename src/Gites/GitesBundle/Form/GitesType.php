<?php

namespace Gites\GitesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GitesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('ville')
            ->add('epis')
            ->add('personnes')
            ->add('chambres')
            ->add('surface')
            ->add('animauxAcceptes')
            ->add('cvAcceptes')
            ->add('urlDispo')
            ->add('urlTarif')
            ->add('urlMap')
            ->add('equipements',null,array('attr'=>array('class'=>'ckeditor')))
            ->add('description',null,array('attr'=>array('class'=>'ckeditor')))
            ->add('descriptioncourte','textarea', array('label'=>'Description rapide (page d\'accueil)','attr'=>array('class'=>'ckeditor')))
            ->add('vignette',null, array('label'=>'Vignette Principale'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gites\GitesBundle\Entity\Gites'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gites_gitesbundle_gites';
    }
}
