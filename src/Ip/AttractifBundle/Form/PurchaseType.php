<?php

namespace Ip\AttractifBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PurchaseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity',   'text' )
            ->add('user', 'entity', array(
                'class'    =>  'IpAttractifBundle:User',
                'property' =>  'username'
            ))
            ->add('product', 'entity', array(
                'class'    =>  'IpAttractifBundle:Product',
                'property' =>  'name'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ip\AttractifBundle\Entity\Purchase'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ip_attractifbundle_purchase';
    }
}
