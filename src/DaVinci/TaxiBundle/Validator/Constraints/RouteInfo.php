<?php

namespace DaVinci\TaxiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class RouteInfo extends Constraint 
{
	
	public $message = 'Error message';
	
	public function getTargets()
	{
       // return self::CLASS_CONSTRAINT;
		return array(self::CLASS_CONSTRAINT, self::PROPERTY_CONSTRAINT);
	}
	
	/*public function validatedBy()
	{
		return 'taxi.passengerRequest.validator.route_info';
	}*/
			
}

?>