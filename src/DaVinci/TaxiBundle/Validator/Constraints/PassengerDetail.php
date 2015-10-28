<?php

namespace DaVinci\TaxiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PassengerDetail extends Constraint 
{
	
	public $message = 'Passenger details has incorrect value: ';
	
	public function getTargets()
	{
    	return array(self::CLASS_CONSTRAINT, self::PROPERTY_CONSTRAINT);
	}
			
}

?>