<?php

namespace DaVinci\TaxiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RouteInfoValidator extends ConstraintValidator
{
	
	public function validate($value, Constraint $constraint)
	{
		die('---');
		if ($value->getRoundTrip()) {
			$this->context->buildViolation($constraint->message)
				->atPath('return')
				->addViolation();
		}
	}
		
}

?>