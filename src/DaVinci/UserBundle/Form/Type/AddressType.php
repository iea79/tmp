<?php

namespace DaVinci\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use DaVinci\UserBundle\Form\EventListener\AddCityFieldSubscriber;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AddressType extends AbstractType {

    /**
     * @var ObjectManager
     */
    private $om;
    private $with_street;

    public function __construct($with_street = true, ObjectManager $om = null) {
        $this->with_street = $with_street;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $propertyPathToCity = 'countrycity';

        $builder
                ->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData')) //adding country filled field
                ->addEventSubscriber(new AddCityFieldSubscriber($propertyPathToCity));
        if ($this->with_street)
            $builder->add('street', 'text');

    }

    protected function addCountry($form, $country = null) {

        //add country field and set default country from post data
        $form->add('country', 'entity', array(
            'class' => 'DaVinci\TaxiBundle\Entity\Admin\CountryCity',
            'property' => 'country',
            'empty_value' => 'form.please_select',
            'translation_domain' => 'FOSUserBundle',
            //'property_path' => 'country',
            'mapped' => false,
            'data' => $country, 
            'query_builder' => function(EntityRepository $er) use ($country){
            
                if($country)            
                {
                    //use passed to post country
                    $cc = $country->getCountryCode();
                    $ci = $country->getId();
                    
                    return $er->createQueryBuilder('c')->select('c')->where('c.status = 1')->andWhere('(c.countryCode != ?1 OR c.id = ?2)')->groupBy('c.countryCode')->orderBy('c.countryCode', 'ASC')->setParameters(array(1 => $cc, 2 => $ci));
                }
                else
                    return $er->createQueryBuilder('c')->select('c')->where('c.status = 1')->groupBy('c.countryCode')->orderBy('c.countryCode', 'ASC');
            }));
    }

    function onPreSetData(FormEvent $event) {

        $form = $event->getForm();
        $data = $event->getData();

        if (isset($data) && $data instanceof \DaVinci\TaxiBundle\Entity\Address) {
            $country = $data->getCountrycity();
            $countrycode = NULL;
            
            if ($form->has('country')) 
                $form->remove('country');
            
            $this->addCountry($form, $country, $countrycode);
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'DaVinci\TaxiBundle\Entity\Address',
        ));
    }

    public function getName() {
        return 'address';
    }

    function getIdentifier() {
        return 'address';
    }

}
