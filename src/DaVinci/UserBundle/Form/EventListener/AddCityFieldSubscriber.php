<?php

namespace DaVinci\UserBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;

class AddCityFieldSubscriber implements EventSubscriberInterface {

    private $propertyPathToCity;

    public function __construct($propertyPathToCity = 'city') {
        $this->propertyPathToCity = $propertyPathToCity;
    }

    public static function getSubscribedEvents() {
        return array(
            FormEvents::PRE_SUBMIT => 'preSetData',
            FormEvents::POST_SET_DATA => 'preSetData'
        );
    }

    private function addCityForm($form, $country,$countrycity = null) {
        $formOptions = array(
            'class' => 'DaVinciTaxiBundle:Admin\CountryCity',
            'empty_value' => ($country == NULL) ? 'form.select_country_first' : 'form.please_select',
            'translation_domain' => 'FOSUserBundle',
            'property' => 'city',
            'data' => $countrycity,
            'query_builder' => function (EntityRepository $repository) use ($country) {
                if ($country == NULL)
                    $country = '';


                if (is_numeric($country)) {
                    $result= $repository->createQueryBuilder('c')
                            ->select('c.countryCode')
                            ->where("c.id = :ctr")
                            ->andWhere('c.status = 1')
                            ->setParameter('ctr', $country)->getQuery()->getSingleResult(); 
                    $country = $result['countryCode'];
                }

                return $repository->createQueryBuilder('c')
                                ->select('c')
                                ->where("c.countryCode = :ctr")
                                ->andWhere('c.status = 1')
                                ->setParameter('ctr', $country);
            }
        );

        $form->add($this->propertyPathToCity, 'entity', $formOptions);
    }

    public function preSetData(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        $country = NULL;
        $countrycity = NULL;
        if (isset($data)) {
            if ($data instanceof \DaVinci\TaxiBundle\Entity\Address)
            {
                $countrycity = $data->getCountrycity();
                if($countrycity)
                     $country = $countrycity->getCountryCode();
                else
                    $country = '';
                
                
            }
            else
            {
                $country = $data['country'];
                $countrycity = isset($data['countrycity'])?$data['countrycity']:NULL;
            }
        }

        if ($form->has($this->propertyPathToCity )) 
            $form->remove($this->propertyPathToCity);
            
        $this->addCityForm($form, $country,$countrycity);
        
    }

}
