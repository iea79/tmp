<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use \Sonata\UserBundle\Form\Type\RegistrationFormType as BaseType;

class OfficePassengerProfileType extends AbstractType {

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
                        ->add('phone')
                        ->add('dateOfBirth', 'birthday', array('label' => 'form.dateOfBirth', 'translation_domain' => 'FOSUserBundle'))             
                        ->add('gender', 'choice', array(
                            'choices' => array(
                                '1' => 'form.male',
                                '0' => 'form.female'
                            ),
                            'required' => false,
                            'empty_value' => 'form.choosegender',
                            'empty_data' => null,
                            'translation_domain' => 'FOSUserBundle'))
                        ->add('photo','iphp_file')
                        ->add('oldPassword','password',array(
                            'label' => 'form.old_password', 'translation_domain' => 'FOSUserBundle',
                            'mapped' => false
                        ))
                        ->add('plainPassword', 'repeated', array(
                            'type' => 'password',
                            'options' => array('translation_domain' => 'FOSUserBundle'),
                            'first_options' => array('label' => 'form.password'),
                            'second_options' => array('label' => 'form.password_confirmation'),
                            'invalid_message' => 'fos_user.password.mismatch',
                        ));

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
        return 'taxi_passenger_office_profile';
    }

}
