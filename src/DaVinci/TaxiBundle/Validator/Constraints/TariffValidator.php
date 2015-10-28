<?php

namespace DaVinci\TaxiBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use DaVinci\TaxiBundle\Entity\PassengerRequest;

class TariffValidator extends ConstraintValidator
{
	
	public function validate($value, Constraint $constraint)
	{
		if (
			$value->getTariff()->getPriceType() == \DaVinci\TaxiBundle\Entity\Tariff::POS_PRICE_TYPE_YOUR
			&& !filter_var(
				$value->getTariff()->getYourPrice(), 
				FILTER_VALIDATE_FLOAT, 
				array('options' => array('min_range' => 0.01))
			)
		) {
			$this->addViolation(
				'yourPrice', 
				$constraint->message . ' price must be more than ' . $value->getTariff()->getYourPrice()
			);
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