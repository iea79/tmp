<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use \Sonata\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationCompanyFormType extends BaseType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        switch ($options['flow_step']) {
            case 1:
                $builder
                        ->add('name', 'text', array('label' => 'form.name_company', 'translation_domain' => 'FOSUserBundle'))
                        ->add('availability', 'choice', array(
                                'choices'   => array(
                                    '5' => '5',
                                    '6' => '6',
                                    '7' => '7',
                                    '8' => '8',
                                    '9' => '9',
                                    '10' => '10',
                                    '15' => '15',
                                    '20' => '20',
                                    '30' => '30',
                                    '40' => '40+'
                                ),
                                'label'  => 'form.number_cars',
                                'translation_domain' => 'FOSUserBundle'
                            ))
                        ->add('country','entity', array(
                            'class' => 'DaVinciTaxiBundle:Country',
                            'property' => 'name',
                            'label' => 'form.company_country', 'translation_domain' => 'FOSUserBundle'));
                break;
            case 2:
                break;
        }
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DaVinci\TaxiBundle\Entity\User'
        ));
    }
    /**
     * @return string
     */
    public function getName() {
        return 'taxi_company_registration';
    }

}
