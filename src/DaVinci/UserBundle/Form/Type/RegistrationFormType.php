<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {


        switch ($options['flow_step']) {
            case 1:
                $builder
                        ->add('first_name', 'text', array('label' => 'form.first_name', 'translation_domain' => 'FOSUserBundle'))
                        ->add('last_name', 'text', array('label' => 'form.last_name', 'translation_domain' => 'FOSUserBundle'))
                        ->add('gender', 'choice', array(
                            'choices' => array(
                                '1' => 'form.male',
                                '0' => 'form.female'
                            ),
                            'required' => true,
                            'empty_value' => 'form.choosegender',
                            'empty_data' => null,
                            'translation_domain' => 'FOSUserBundle'))
                        ->add('birthday', 'birthday', array('label' => 'form.birthday', 'translation_domain' => 'FOSUserBundle'));
                break;
            case 2:
                $builder
                        ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
                        ->add('plainPassword', 'repeated', array(
                            'type' => 'password',
                            'options' => array('translation_domain' => 'FOSUserBundle'),
                            'first_options' => array('label' => 'form.password'),
                            'second_options' => array('label' => 'form.password_confirmation'),
                            'invalid_message' => 'fos_user.password.mismatch',
                            ))
                        ->add(
                               'terms',
                               'checkbox',
                               array('property_path' => 'termsAccepted')
                           );
                break;
        }
    }

    /**
     * @return string
     */
    public function getName() {
        return 'taxi_user_registration';
    }

}
