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
                        /*->add('country', 'entity', array(
                            'class' => 'DaVinci\TaxiBundle\Entity\Admin\CountryCity',
                            'data_class' => 'DaVinci\TaxiBundle\Entity\Address',
                            'property' => 'country',
                            'empty_value' => 'form.please_select',
                            'translation_domain' => 'FOSUserBundle',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('c')->where('c.status = 1' )->groupBy('c.countryCode')->orderBy('c.countryCode', 'ASC');
                            }))
                        ->addEventSubscriber(new AddCityFieldSubscriber($propertyPathToCity))
                        ->add('street', 'text')*/
                        ->add('address', new AddressType())
                        ->add('skype', 'text');
                        
                    
          /*              ->add('country', 'entity', array(
                            'class' => 'DaVinci\TaxiBundle\Entity\Admin\CountryCity',
                            'property' => 'country',
                            'empty_value' => 'form.please_select',
                            'translation_domain' => 'FOSUserBundle',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('c')->where('c.status = 1' )->groupBy('c.countryCode')->orderBy('c.countryCode', 'ASC');
                            },
                            'mapped' => false))
                        ->add;


                $builder->addEventListener(FormEvents::PRE_SET_DATA, 
                        function (FormEvent $event) {

                    $form = $event->getForm();
                    $data = $event->getData();
                    
                    
                    
                        if ($form->has('city')) {
                            $form->remove('city');
                        }
                        
                        if (isset($data->country)) {
                            $msg = 'Please give a correct line number';
                            //$form->get('country')->addError(new FormError($msg));
                           // var_dump($data->country,  get_class($form->get('country')->getData()));
                        }

                       // if ($data instanceof \DaVinci\TaxiBundle\Entity\Admin\CountryCity) {

                       // }

                        //$country = isset($data->country) ? $data->country : null;

     
                        //TODO: сейчас показываются все города, нужно нормально сделать
                        //как в SMTC посмотреть
                        $form->add('city', 'entity', array(
                            'class' => 'DaVinci\TaxiBundle\Entity\Admin\CountryCity',
                            'property' => 'city',
                            'empty_value' => 'form.please_select',
                            'translation_domain' => 'FOSUserBundle',
                            'query_builder' => function(EntityRepository $er)  {
                                    return $er
                                    ->createQueryBuilder('c')
                                    ->where('c.countryCode = :ctr' )
                                    ->andWhere('c.status = 1')
                                    ->setParameter('ctr', 'RU');
                                },
                            'mapped' => false
                        ));
  
                });*/
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
