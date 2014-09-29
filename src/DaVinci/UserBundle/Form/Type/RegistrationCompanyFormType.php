<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType as BaseType;
use Doctrine\ORM\EntityRepository;

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
                        ->add('country', 'entity', array(
                            'class' => 'DaVinci\TaxiBundle\Entity\Admin\CountryCity',
                            'property' => 'country',
                            'empty_value' => 'form.please_select',
                            'translation_domain' => 'FOSUserBundle',
                            'query_builder' => function(EntityRepository $er) {
                                return $er->createQueryBuilder('c')->where('c.status = 1' )->groupBy('c.countryCode')->orderBy('c.countryCode', 'ASC');
                            },
                            'mapped' => false
                ));

                $locale = $this->session->get('_locale');

                $builder->addEventListener(FormEvents::PRE_SET_DATA, 
                        function (FormEvent $event) use ($locale) {

                    $form = $event->getForm();
                    $data = $form['country']->getData();
                    
                    if ($form->has('city')) {
                        $form->remove('city');
                    }

                    $country = isset($data->country) ? $data->country : null;
var_dump($data);exit;
                    //$locale = $this->container->get('session')->get('_locale');
                    
                    $form->add('city', 'entity', array(
                        'class' => 'DaVinci\TaxiBundle\Entity\Admin\CountryCity',
                        'property' => 'city',
                        'empty_value' => 'form.please_select',
                        'translation_domain' => 'FOSUserBundle',
                        'query_builder' => function(EntityRepository $er) use ($country) {
                                return $er
                                ->createQueryBuilder('c')
                                ->where('c.countryCode = :ctr' )
                                ->andWhere('c.status = 1')
                                ->setParameter('ctr', $country);
                            },
                        'mapped' => false
                    ));
                });
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
