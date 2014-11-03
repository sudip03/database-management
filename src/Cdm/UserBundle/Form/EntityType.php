<?php

namespace Cdm\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of Entity Type
 * 
 */

class EntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('name', 'text', array('attr'=>array('class'=>'form-control'),
                                            'label'=>'Nombre'));
        
        $builder->add('surname', 'text', array('attr'=>array('class'=>'form-control'),
                                                'label'=>'apellidos'));
        
        $builder->add('email', 'email', array('attr'=>array('class'=>'form-control')));
        
        $builder->add('sex', 'entity', array('attr'=>array('class'=>'form-control'),
                                                'class' => 'CdmUserBundle:Sex',
                                                'property' => 'description',
                                                'empty_value' => 'Select Sex'));
        
        $builder->add('dni', 'text', array('attr'=>array('class'=>'form-control')));
        
        $builder->add('alias', 'text', array('attr'=>array('class'=>'form-control')));
        
        $builder->add('dob', 'text', array('attr'=>array('class'=>'form-control datepicker'),
                                            'label'=>'f_nacimiento'));
        
        $builder->add('ata', 'text', array('attr'=>array('class'=>'form-control'),
                                            'label'=>'f_ata'));
        
        $builder->add('baja', 'text', array('attr'=>array('class'=>'form-control'),
                                            'label'=>'baja'));
        
        $builder->add('phone', 'text', array('attr'=>array('class'=>'form-control'),
                                            'label'=>'phone'));
        
        $builder->add('street', 'text', array('attr'=>array('class'=>'form-control'),
                                            'label'=>'street'));
        
        $builder->add('city', 'text', array('attr'=>array('class'=>'form-control'),
                                            'label'=>'city'));
        
        $builder->add('country', 'text', array('attr'=>array('class'=>'form-control'),
                                            'label'=>'country'));
        
        $builder->add('zip', 'text', array('attr'=>array('class'=>'form-control'),
                                            'label'=>'zip'));
        
        $builder->add('population', 'text', array('attr'=>array('class'=>'form-control'),
                                            'label'=>'population'));
        
        $builder->add('photo', new \Cdm\CommonBundle\Form\UploadType(), array('attr'=>array('class'=>'form-control'),
                                                                                'required'=>false));
                                                                                
        $builder->add('group', 'entity', array('class' => 'CdmUserBundle:Group',
                                                'property' => 'description',
                                                'multiple' => false,
                                                'expanded' => true));                                      
        
        $builder->add('save', 'submit', array('attr'=>array('class'=>'form-control btn btn-success'),
                                              'label'=>'Save'));
        
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdm\UserBundle\Entity\Entity',
        ));
    }
    
    public function getName() 
    {
        return 'Entity';
    }
}