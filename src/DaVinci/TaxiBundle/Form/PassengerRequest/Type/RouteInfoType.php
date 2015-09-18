<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RouteInfoType extends AbstractType 
{
	
	public function buildForm(FormBuilderInterface $builder, array $options) 
    {
		$builder
			->add('distance', 'hidden')
			->add('duration', 'hidden')
			->add('routePoints', 'collection', array(
				'type' => new RoutePointType(),
				'error_bubbling' => false,
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
				'cascade_validation' => true
			))
			->add('roundTrip', 'checkbox')
			->add('pickUpDate', 'date', array(
				'widget' => 'single_text',
				'format' => 'dd.MM.yy',
				'required' => false
			))
			->add('pickUpTime', 'time', array(
				'widget' => 'choice',
				'required' => false
			))
			->add('returnDate', 'date', array(
				'widget' => 'single_text', 
				'format' => 'dd.MM.yy',
				'required' => false
			))
			->add('returnTime', 'time', array(
				'widget' => 'choice',
				'required' => false
			));
	}
	
	public function getName() {
		return 'createPassengerRequestRouteInfo';
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' =>	'DaVinci\TaxiBundle\Entity\PassengerRequest',
			'validation_groups' => array('flow_createPassengerRequest_step1'),
			'csrf_protection' => false
		));
	}
	
}

?>