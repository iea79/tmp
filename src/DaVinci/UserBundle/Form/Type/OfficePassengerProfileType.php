<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use \Sonata\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

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
                        ->add('dateOfBirth', 'birthday', array('label' => 'form.dateOfBirth', 'translation_domain' => 'FOSUserBundle',
                            'placeholder' =>'form.please_select',
                            'required' => false))             
                        ->add('gender', 'choice', array(
                            'choices' => array(
                                '1' => 'form.male',
                                '0' => 'form.female'
                            ),
                            'required' => false,
                            'placeholder' => 'form.choosegender',
                            'empty_data' => null,
                            'translation_domain' => 'FOSUserBundle'))
                        ->add('photo','file', array('required' => false,'data_class'=>null))
                        ->add('current_password', 'password', array(
                            'label' => 'form.current_password',
                            'translation_domain' => 'FOSUserBundle',
                            'mapped' => false,
                            'required' => false,
                        ))
                        ->add('new', 'repeated', array(
                            'type' => 'password',
                            'options' => array('translation_domain' => 'FOSUserBundle'),
                            'first_options' => array('label' => 'form.new_password'),
                            'second_options' => array('label' => 'form.new_password_confirmation'),
                            'invalid_message' => 'fos_user.password.mismatch',
                            'mapped' => false,
                            'required' => false
                        ));
                
                //add validation on pass only if filled
                $builder->addEventListener(FormEvents::PRE_SUBMIT, function ($event) {
                    $data = $event->getData();
                    $form = $event->getForm();

                    if (null === $data) {
                        return;
                    }
                    
                    if (!empty($data['current_password'])) {
                        $form
                            ->add('current_password', 'password', array(
                            'label' => 'form.current_password',
                            'translation_domain' => 'FOSUserBundle',
                            'mapped' => false,
                            'required' => false,
                            'constraints' => new UserPassword(),
                        ));
                    }
                });

    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DaVinci\TaxiBundle\Entity\User',
            'validation_groups' =>  array('full', 'Default'),
        ));
    }
    
    
    /**
     * @return string
     */
    public function getName() {
        return 'taxi_passenger_office_profile';
    }

}
