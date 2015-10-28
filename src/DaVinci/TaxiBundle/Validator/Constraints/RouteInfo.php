<?php

namespace DaVinci\TaxiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class RouteInfo extends Constraint 
{
	
	public $message = 'Route info has incorrect value: ';
	
	public function getTargets()
	{
    	return array(self::CLASS_CONSTRAINT, self::PROPERTY_CONSTRAINT);
	}
			
}

?>