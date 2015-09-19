<?php

namespace DaVinci\TaxiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Tariff extends Constraint 
{
	
	public $message = 'Tariff has wrong values: ';
	
	public function getTargets()
	{
    	return array(self::CLASS_CONSTRAINT, self::PROPERTY_CONSTRAINT);
	}
			
}

?>