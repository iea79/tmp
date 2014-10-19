<?php

namespace DaVinci\UserBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;


class AddCityFieldSubscriber implements EventSubscriberInterface
{
    private $propertyPathToCity;

    public function __construct($propertyPathToCity = 'city')
    {
        $this->propertyPathToCity = $propertyPathToCity;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SUBMIT => 'preSetData',
            FormEvents::POST_SET_DATA    => 'postSetData'
        );
    }

 private function addCityForm($form, $country) {
        $formOptions = array(
            'class' => 'DaVinciTaxiBundle:Admin\CountryCity',
            'empty_value' => ($country == NULL) ? 'form.select_country_first' : 'form.please_select',
            'translation_domain' => 'FOSUserBundle',
            'property' => 'city',
            'query_builder' => function (EntityRepository $repository) use ($country) {
                if ($country == NULL)
                    $countyr = '';

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

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (!$data['country']) {
            return;
        }

        $this->addCityForm($form, $data['country']);
    }

    public function postSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();
        
        $country = NULL;
        if (isset($data)) { 
            
            if($data instanceof \DaVinci\TaxiBundle\Entity\Address)
                $country = $data->getCountry();
            else
                $country = $data['country'];
        }

        if (!$form->has($this->propertyPathToCity)) {
            $this->addCityForm($form, $country);
        }
        
        
    }
}
