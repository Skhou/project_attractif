<?php

namespace Ip\AttractifBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref',        'text')
            ->add('name',       'text')
            ->add('description','textarea' )
            ->add('price',      'text')
            ->add('stock',      'text')
            ->add('file',      'file', array("required" => false))
            ->add('category',   'entity', array(
                'class'     =>  'IpAttractifBundle:Category',
                'property'  =>  'name'
            ))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ip\AttractifBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ip_attractifbundle_product';
    }
}
