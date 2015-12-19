<?php

namespace Gites\GitesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SlidesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file','file',array('label'=>'Image du slide', 'required'=>false))
            ->add('genre', 'choice', array(
                'choices'  => array(
                    'Slide' => 'Slide',
                    'News' => 'News',
                ),
                // *this line is important*
                'choices_as_values' => true,
                'expanded'=>true
            ))
            ->add('titre')
            ->add('soustitre')
            ->add('url')
            ->add('lien')
            ->add('lienStyle')
            ->add('lienTarget', 'choice', array(
                'choices'  => array(
                    'Page en cours' => '',
                    'Nouvelle page' => '_blank',
                ),
                // *this line is important*
                'choices_as_values' => true,
                'expanded'=>true
            ))
            ->add('legendePhoto')
            ->add('sousLegendePhoto')

            ->add('dateParutionDebut')
            ->add('dateParutionFin')
            ->add('ordre')

                    ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gites\GitesBundle\Entity\Slides'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gites_gitesbundle_slides';
    }
}
