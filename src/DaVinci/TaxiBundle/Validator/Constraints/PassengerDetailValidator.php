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
				false === $this->checkMobileCode($value->getPassengerDetail()->getMobileCode())
				&& false === $this->checkMobilePhone($value->getPassengerDetail()->getMobilePhone())
			) {
				$this->addViolation('mobilePhone', $constraint->message . 'phone format mismatch');
			}
		}
	}
	
	private function checkMobileCode($code)
	{
		return filter_var(
			$code,
			FILTER_VALIDATE_INT,
			array('options' => array('min_range' => 1))
		);
	}
	
	private function checkMobilePhone($phone)
	{
		return filter_var(
			$phone,
			FILTER_VALIDATE_REGEXP,
			array('options' => array('regexp' => '/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/'))
		);
	}
	
	private function addViolation($field, $message)
	{
		$this->context->buildViolation($message)
			->atPath($field)
			->addViolation();
	}
		
}

?>