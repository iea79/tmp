<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DaVinci\UserBundle\Form\Type\OfficeDriversPassengerFormType;

class OfficeDriverProfileType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {

                $builder
                    /*    ->add('firstname', 'text', array('label' => 'form.firstname', 'translation_domain' => 'FOSUserBundle',
                            'attr' => array('title' => 'fos_user.firstname.latin', 'pattern' => '^[a-zA-Z ]+$')))
                        ->add('lastname', 'text', array('label' => 'form.lastname', 'translation_domain' => 'FOSUserBundle',
                            'attr' => array('title' => 'fos_user.lastname.latin', 'pattern' => '^[a-zA-Z ]+$')))
                        ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))*/
                        ->add('language', new LanguageType(),array('property_path'=>'user.language',
                            'data_class' => 'DaVinci\TaxiBundle\Entity\Language'))
                        ->add('address', new AddressType(false))
                       /* ->add('skype', 'text', array('required'=>false,'property_path'=>'user.skype'))*/
                        ->add('experience', 'choice', array(
                            'choices' => \DaVinci\TaxiBundle\Entity\IndependentDriver::getDriverExperienceOptions(),
                            'empty_value' => 'form.please_select',
                            'label' => 'form.english',
                            'translation_domain' => 'FOSUserBundle'
                        ))
                        ->add('phones','collection',array(
                                'type'         => new PhoneType(),
                                'allow_add'    => true,
                                'error_bubbling' => false,
                                'cascade_validation' => true))
                       /* ->add('dateOfBirth', 'birthday', array('label' => 'form.dateOfBirth', 'translation_domain' => 'FOSUserBundle',
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
                            'translation_domain' => 'FOSUserBundle'))*/ 
                        ->add('about', 'textarea', array(
                            'required' => false
                        ))
                        ->add('user', new OfficeDriversPassengerFormType())
                        ->add('insuranceAccepted', 'checkbox', array(
                            'required' => true
                        ))
                        ->add('vehicle', new DriverVehicleType());

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
        return 'taxi_driver_office_profile';
    }

}
