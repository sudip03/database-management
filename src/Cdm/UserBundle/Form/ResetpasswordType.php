<?php

namespace Cdm\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Description of Reset password Type
 * 
 */
class ResetpasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('password', 'repeated', array(
            
            'first_options' => array(
                'label' => 'New Password',
                'attr' => array(
                    'placeholder' => 'New Password',
                    'class' => 'form-control'
                )),
            
            'second_options' => array(
                'label' => 'Confirm Password',
                'attr' => array(
                    'placeholder' => 'Confirm Password',
                    'class' => 'form-control'
                )),
            
            'type' => 'password',   
            
            'invalid_message' => 'Passwords do not match',
            
            'required' => true,
        ));
        
        $builder->add('save', 'submit', array('attr'=>array('class'=>'form-control'),
                                              'label'=>'Save'));        
    }
     
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdm\UserBundle\Entity\User',
        ));
    }
    
    public function getName() 
    {
        return 'resetpassword';
    }
}