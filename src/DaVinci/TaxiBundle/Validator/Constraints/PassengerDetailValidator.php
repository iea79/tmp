<?php

namespace DaVinci\TaxiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use DaVinci\TaxiBundle\Entity\PassengerRequest;

class PassengerDetailValidator extends ConstraintValidator
{
	
	public function validate($value, Constraint $constraint)
	{
		if ($value->getPassengerDetail()->getNotMySelf()) {
			if (!strlen($value->getPassengerDetail()->getName())) {
				$this->addViolation('name', $constraint->message . 'name is empty');
			}
			
			if (
				!$value->getPassengerDetail()->getMobileCode()
				|| !$value->getPassengerDetail()->getMobilePhone()
			) {
				$this->addViolation('mobilePhone', $constraint->message . 'phone must be filled');
			}
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