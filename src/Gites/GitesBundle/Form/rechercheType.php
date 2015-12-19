<?php
namespace Gites\GitesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class rechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder->add('recherche','text',array('label'=>false,
                                                'attr'=>array('class'=>'input-medium search-query')
                                              )
                     );

    }
    public function getName()
    {
        return 'Gites_Gitesbundle_recherche';
    }
}
