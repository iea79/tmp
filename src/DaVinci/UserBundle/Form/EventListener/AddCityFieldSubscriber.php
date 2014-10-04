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

    private function addCityForm($form, $country)
    {
        $formOptions = array(
            'class'         => 'DaVinciTaxiBundle:Admin\CountryCity',
            'empty_value' => 'form.please_select',
            'translation_domain' => 'FOSUserBundle',
            'property' => 'city',
            'query_builder' => function (EntityRepository $repository) use ($country) {
                return  $repository->createQueryBuilder('c')
                        ->where('c.id = :ctr' )
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
        
        if (!$form->has($this->propertyPathToCity)) {
             $form->add($this->propertyPathToCity, 'choice', array('choices' => array('0'=>'form.loading'),'translation_domain' => 'FOSUserBundle'));
           //$this->addCityForm($form, null);
        }
        
        
    }
}
