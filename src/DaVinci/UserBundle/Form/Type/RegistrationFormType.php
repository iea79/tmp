<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType as BaseType;

class RegistrationFormType extends BaseType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        switch ($options['flow_step']) {
            case 1:
                $builder
                        ->add('firstname', 'text', array('label' => 'form.firstname', 'translation_domain' => 'FOSUserBundle',
                            'attr' => array('title' => 'fos_user.firstname.latin', 'pattern' => '^[a-zA-Z ]+$')))
                        ->add('lastname', 'text', array('label' => 'form.lastname', 'translation_domain' => 'FOSUserBundle',
                            'attr' => array('title' => 'fos_user.lastname.latin', 'pattern' => '^[a-zA-Z ]+$')))
                        ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
                        ->add('plainPassword', 'repeated', array(
                            'type' => 'password',
                            'options' => array('translation_domain' => 'FOSUserBundle'),
                            'first_options' => array('label' => 'form.password'),
                            'second_options' => array('label' => 'form.password_confirmation'),
                            'invalid_message' => 'fos_user.password.mismatch',
                        ));
                break;
            
            case 2:
                       $builder->add('terms', 'checkbox', array('property_path' => 'termsAccepted'));
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
        return 'taxi_user_registration';
    }

}
