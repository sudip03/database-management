<?php

namespace Cdm\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            
            $builder->add('name', 'hidden');           
            $builder->add('file', 'file', array('label' => false));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdm\CommonBundle\Entity\Upload'
        ));
    }

    public function getName()
    {
        return 'upload';
    }
}