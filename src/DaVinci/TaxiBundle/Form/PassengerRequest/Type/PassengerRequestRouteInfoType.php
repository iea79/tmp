<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PassengerRequestRouteInfoType extends AbstractType {
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('from_point', new PassengerRequestRoutePointType())
			->add('destination_point', 'collection', array('type' => new PassengerRequestRoutePointType()))
			->add('to_point', new PassengerRequestRoutePointType())
			->add('pick_up', 'datetime', array('date_format' => 'Y-m-d H:i'))
			->add('round_trip', null, array('mapped' => false))
			->add('return', 'datetime', array('date_format' => 'Y-m-d H:i'));
	}
	
	public function getName() {
		return 'RouteInfo';
	}
	
}

?>