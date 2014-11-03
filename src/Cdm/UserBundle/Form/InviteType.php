<?php

namespace Cdm\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Description of Invite Type
 * 
 * Based on user entity
 */
class InviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('name', 'text', array('attr'=>array('class'=>'form-control'),
                                            'mapped'=> false));
        
        $builder->add('surname', 'text', array('attr'=>array('class'=>'form-control'),
                                            'mapped'=> false));
        
        $builder->add('email', 'email', array('attr'=>array('class'=>'form-control')));
        
        $builder->add('description', 'entity', array('attr' => array('class'=>'form-control'),
                                                 'class' => 'CdmUserBundle:Manager',
                                                 'property' => 'description',                                                 
                                                 'mapped'=> false,
                                                 'empty_value' => 'Select Manager'
                                                  ));
        
        $builder->add('save', 'submit', array('attr'=>array('class'=>'form-control'),
                                              'label'=>'Invite'));        
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdm\UserBundle\Entity\User',
        ));
    }
    
    public function getName() 
    {
        return 'User';
    }
}