<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType as BaseType;

class RegistrationIndependentDriverFormType extends BaseType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        switch ($options['flow_step']) {
            case 1:
                $builder
                        ->add('language', new LanguageType(),array('property_path'=>'user.language',
                            'data_class' => 'DaVinci\TaxiBundle\Entity\Language'))
                        ->add('address', new AddressType(false))
                        ->add('skype', 'text', array('required'=>false,'property_path'=>'user.skype'))
                        ->add('phones','collection',array(
                                'type'         => new PhoneType(),
                                'allow_add'    => true,
                                'error_bubbling' => false,
                                'cascade_validation' => true));
                break;
            case 2:
                       $builder->add('terms', 'checkbox', array('property_path' => 'termsAccepted'));
                break;
        }
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DaVinci\TaxiBundle\Entity\IndependentDriver'
        ));
    }
    /**
     * @return string
     */
    public function getName() {
        return 'taxi_independent_driver_registration';
    }

}
