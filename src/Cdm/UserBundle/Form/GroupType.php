<?php

namespace Cdm\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of Group Type
 * 
 * Based on group entity
 */
class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('description', 'text', array('attr'=>array('class'=>'form-control')
                                            ));
        
        $builder->add('role', 'entity', array('class'=>'CdmUserBundle:Role',
                                                'property'=>'description',
                                                'multiple'=>true,
                                                'expanded'=>true));
        
        $builder->add('active', 'checkbox', array('attr'=>array('class'=>'form-control'),
                                                'required'=>false,));
        
        $builder->add('save', 'submit', array('attr'=>array('class'=>'form-control btn btn-success'),
                                              'label'=>'Save'));        
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdm\UserBundle\Entity\Group',
        ));
    }
    
    public function getName() 
    {
        return 'Group';
    }
}