<?php

namespace DaVinci\TaxiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use DaVinci\TaxiBundle\Entity\PassengerRequest;

class RouteInfoValidator extends ConstraintValidator
{
	
	public function validate($value, Constraint $constraint)
	{
		if (!$this->hasPickUp($value)) {
			return;
		}

		$this->validateTimeParams($value, $constraint);
	}
	
	private function validateTimeParams($value, Constraint $constraint)
	{
		$pickUp = \DateTime::createFromFormat(
			'Y-m-d H:i:s',
			$value->getPickUpDate()->format('Y-m-d') . ' ' . $value->getPickUpTime()->format('H:i:s')
		);
		if (1 == PassengerRequest::getAvailablePickUp()->diff($pickUp)->invert) {
			$this->addViolation('pickUp', $constraint->message . 'pick up value is less than available');
			return;
		}
		
		if ($value->getRoundTrip()) {
			if (!$this->hasReturn($value)) {
				$this->addViolation('return', $constraint->message . 'return value is empty');
				return;
			}
			$return = \DateTime::createFromFormat(
				'Y-m-d H:i:s',
				$value->getReturnDate()->format('Y-m-d') . ' ' . $value->getReturnTime()->format('H:i:s')
			);
				
			if (1 == $pickUp->diff($return)->invert) {
				$this->addViolation('return', $constraint->message);
			}
		}
	}
		
	private function hasPickUp($value)
	{
		return $value->getPickUpDate() && $value->getPickUpTime();			
	}
	
	private function hasReturn($value)
	{
		return $value->getReturnDate() && $value->getReturnTime();
	}
	
	private function addViolation($field, $message)
	{
		$this->context->buildViolation($message)
			->atPath($field)
			->addViolation();
	}
		
}

?>