<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PhoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('phone','text')
            ->add('has_internet','checkbox',array(
                'required'  => false
                ))
            ->add('has_whatsapp','checkbox',array(
                'required'  => false
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DaVinci\TaxiBundle\Entity\Phone',
        ));
    }

    public function getName()
    {
        return 'phone';
    }

    function getIdentifier()
    {
        return 'phone';
    }
}
