<?php

namespace DaVinci\TaxiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use DaVinci\TaxiBundle\Entity\PassengerRequest;

class PassengerDetailValidator extends ConstraintValidator
{
	
	public function validate($value, Constraint $constraint)
	{
		if ($value->getPriceType()) {
			
		}
	}
	
	private function addViolation($field, $message)
	{
		$this->context->buildViolation($message)
			->atPath($field)
			->addViolation();
	}
		
}

?>