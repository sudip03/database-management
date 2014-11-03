<?php

namespace Cdm\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of Sex Type
 * 
 * Based on sex entity
 */
class SexType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('description', 'text', array('attr'=>array('class'=>'form-control')
                                            ));
             
        $builder->add('save', 'submit', array('attr'=>array('class'=>'form-control btn btn-success'),
                                              'label'=>'Save'));        
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdm\UserBundle\Entity\Sex',
        ));
    }
    
    public function getName() 
    {
        return 'Sex';
    }
}