<?php

namespace Ip\AttractifBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',        'text')
            ->add('description', 'textarea')
            ->add('place', 'text')
            ->add('file', 'file', array("required" => false))
            ->add('startDate',   'date', array(
                'format' => 'dd/MM/yyyy',
                'widget' => 'single_text',
            ))
            ->add('endDate',     'date', array(
                'format' => 'dd/MM/yyyy',
                'widget' => 'single_text',
            ))
            ->add('location', 'entity', array(
                'class'     => 'IpAttractifBundle:Location',
                'property'  => 'name'
            ))
            ->add('products', 'entity', array(
                'class'     => 'IpAttractifBundle:Product',
                'property'  => 'name',
                'multiple'  => true,
                'expanded'  => true,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ip\AttractifBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ip_attractifbundle_event';
    }
}
