<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType as BaseType;
use Doctrine\ORM\EntityRepository;
use DaVinci\UserBundle\Form\EventListener\AddCityFieldSubscriber;
use DaVinci\TaxiBundle\Entity\Address;

class RegistrationCompanyFormType extends BaseType {

    private $session;
    public function __construct($session)
    {
        $this->session = $session;
    }

    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $propertyPathToCity = 'city';
        
        
        switch ($options['flow_step']) {
            case 1:
                $builder
                        ->add('name', 'text', array('label' => 'form.name_company', 'translation_domain' => 'FOSUserBundle'))
                        ->add('cars_amount', 'choice', array(
                            'choices' => array(
                                '5' => '5-10',
                                '10' => '10-15',
                                '15' => '15-20',
                                '20' => '20-30',
                                '30' => '30-40',
                                '40' => '40+'
                            ),
                            'empty_value' => 'form.please_select',
                            'label' => 'form.number_cars',
                            'translation_domain' => 'FOSUserBundle'
                        ))
                        ->add('address', new AddressType())
                        ->add('skype')
                        ->add('phones','collection',array(
                                'type'         => new PhoneType(),
                                'allow_add'    => true ));
                break;
            case 2:
                break;
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'class' => 'DaVinci\TaxiBundle\Entity\TaxiCompany'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'taxi_company_registration';
    }

}
