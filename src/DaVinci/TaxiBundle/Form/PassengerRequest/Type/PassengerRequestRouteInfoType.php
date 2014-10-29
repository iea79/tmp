<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PassengerRequestRouteInfoType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('route_points', 'collection', array('type' => new PassengerRequestRoutePointType()))
			->add('pick_up_date', 'date', array('format' => 'MM/dd/yy', 'widget' => 'single_text', 'mapped' => false))
			->add('pick_up_hour', 'datetime', array('format' => 'HH', 'widget' => 'choice', 'mapped' => false))
			->add('pick_up_minute', 'datetime', array('format' => 'mm', 'widget' => 'choice', 'mapped' => false))
			->add('round_trip', 'checkbox', array('mapped' => false))
			->add('return_date', 'date', array('format' => 'MM/dd/yy', 'widget' => 'single_text', 'mapped' => false))
			->add('return_hour', 'datetime', array('format' => 'HH', 'widget' => 'choice', 'mapped' => false))
			->add('return_minute', 'datetime', array('format' => 'mm', 'widget' => 'choice', 'mapped' => false));
	}
	
	public function getName() {
		return 'route_info';
	}
	
}

?>