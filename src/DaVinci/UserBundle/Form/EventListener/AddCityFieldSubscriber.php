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

    public function __construct($propertyPathToCity)
    {
        $this->propertyPathToCity = $propertyPathToCity;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::POST_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT    => 'preSubmit'
        );
    }

    private function addCityForm($form, $country)
    {
        $formOptions = array(
            'class'         => '\DaVinci\TaxiBundle\Entity\Admin\CountryCity',
            'empty_value' => 'form.please_select',
            'translation_domain' => 'FOSUserBundle',
            'query_builder' => function (EntityRepository $repository) use ($country) {
                return $er->createQueryBuilder('c')
                        ->where('c.countryCode = :ctr' )
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

        if (null === $data) {
            return;
        }

        $accessor    = PropertyAccess::createPropertyAccessor();

        $city        = $accessor->getValue($data, $this->propertyPathToCity);
        
        $countrycity = new \DaVinci\TaxiBundle\Entity\Admin\CountryCity;
        
        $country = ($city) ? $this->getDoctrine()->getRepository('\DaVinci\TaxiBundle\Entity\Admin\CountryCityRepository')
                ->getCountryCodeByCity($city) : null;

        $this->addCityForm($form, $country);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $country = array_key_exists('country', $data) ? $data['country'] : null;

        $this->addCityForm($form, $country);
    }
}
