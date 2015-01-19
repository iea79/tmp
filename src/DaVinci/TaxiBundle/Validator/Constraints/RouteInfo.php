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
		return self::CLASS_CONSTRAINT;
	}
			
}

?>