<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

use DaVinci\TaxiBundle\Form\PassengerRequest\Type\PassengerRequestRouteInfoType;

class CreatePassengerRequestFlow extends FormFlow {
	
	const FLOW_NAME = 'createPassengerRequest';
	
	public function getName() {
		return self::FLOW_NAME;
	}
	
	protected function loadStepsConfig() {
		return array(
			array(
				'label' => 'routing',
				'type' => new PassengerRequestRouteInfoType()	
			)
		);
	}
	
}

?>