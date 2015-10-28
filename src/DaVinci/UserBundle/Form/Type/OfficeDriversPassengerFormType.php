<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OfficeDriversPassengerFormType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

                $builder
                        ->add('firstname', 'text', array('label' => 'form.firstname', 'translation_domain' => 'FOSUserBundle',
                            'attr' => array('title' => 'fos_user.firstname.latin', 'pattern' => '^[a-zA-Z ]+$')))
                        ->add('lastname', 'text', array('label' => 'form.lastname', 'translation_domain' => 'FOSUserBundle',
                            'attr' => array('title' => 'fos_user.lastname.latin', 'pattern' => '^[a-zA-Z ]+$')))
                        ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
                        ->add('skype', 'text', array('label' => 'form.skype', 
                            'translation_domain' => 'FOSUserBundle',
                            'required'=>false))
                        ->add('dateOfBirth', 'birthday', array('label' => 'form.dateOfBirth', 'translation_domain' => 'FOSUserBundle',
                            'empty_value' =>'form.please_select',
                            'required' => false))             
                        ->add('gender', 'choice', array(
                            'choices' => array(
                                '1' => 'form.male',
                                '0' => 'form.female'
                            ),
                            'required' => false,
                            'empty_value' => 'form.choosegender',
                            'empty_data' => null,
                            'translation_domain' => 'FOSUserBundle'))
                       // ->add('photo','file', array('required' => false,'data_class'=>null))
;
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
        return 'taxi_passenger_driver_office_profile';
    }

}
