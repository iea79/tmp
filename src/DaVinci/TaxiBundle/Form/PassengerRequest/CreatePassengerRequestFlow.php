<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

use DaVinci\TaxiBundle\Form\PassengerRequest\Type\RouteInfoType;
use DaVinci\TaxiBundle\Form\PassengerRequest\Type\VehicleInfoType;
use DaVinci\TaxiBundle\Form\PassengerRequest\Type\PassengerInfoType;
use DaVinci\TaxiBundle\Form\PassengerRequest\Type\ConfirmationInfoType;

class CreatePassengerRequestFlow extends FormFlow {
	
	const FLOW_NAME = 'createPassengerRequest';
	
	public function getName() {
		return self::FLOW_NAME;
	}
	
	protected function loadStepsConfig() {
		return array(
			array(
				'label' => 'route_info',
				'type' => new RouteInfoType()	
			),
			array(
				'label' => 'vehicle_info',
				'type' => new VehicleInfoType()
			),
			array(
				'label' => 'passenger_info',
				'type' => new PassengerInfoType()
			),
			array(
				'label' => 'confirm_action',
				'type' => new ConfirmationInfoType()	
			)
		);
	}
	
}

?>