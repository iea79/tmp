<?php

namespace DaVinci\TaxiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use DaVinci\TaxiBundle\Entity\PassengerRequest;

class RouteInfoValidator extends ConstraintValidator
{
	
	public function validate($value, Constraint $constraint)
	{
		$currentDate = new \DateTime('now');
		
		$pickUp = \DateTime::createFromFormat(
			'Y-m-d H:i:s',
			$value->getPickUpDate()->format('Y-m-d') . ' ' . $value->getPickUpTime()->format('H:i:s')
		);
		if (1 == $currentDate->diff($pickUp)->invert) {
			$this->context->buildViolation($constraint->message . $pickUp->format('Y-m-d H:i:s'))
				->atPath('pickUp')
				->addViolation();
		}
		
		$return = \DateTime::createFromFormat(
			'Y-m-d H:i:s',
			$value->getReturnDate()->format('Y-m-d') . ' ' . $value->getReturnTime()->format('H:i:s')
		);
				
        if ($value->getRoundTrip() && 1 == $pickUp->diff($return)->invert) {
        	$this->context->buildViolation($constraint->message)
				->atPath('return')
				->addViolation();
        }
	}
		
}

?>