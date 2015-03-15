<?php

namespace DaVinci\TaxiBundle\Form\Payment;

class InternalPaymentMethod extends PaymentMethod
{
	
	const POS_BALANCE_TYPE_PRIVATE = 1;
	const POS_BALANCE_TYPE_BUSINESS = 2;
	
	const BALANCE_TYPE_PRIVATE = 'Private';
	const BALANCE_TYPE_BUSINESS = 'Business';
	
	private $accountId;
		
	static public $subTypes = array(
		self::POS_BALANCE_TYPE_PRIVATE => self::BALANCE_TYPE_PRIVATE,
		self::POS_BALANCE_TYPE_BUSINESS => self::BALANCE_TYPE_BUSINESS
	);
	
	public function setAccountId($accountId)
	{
		$this->accountId = $accountId;
		
		return $this;
	}
	
	public function getAccountId()
	{
		return $this->accountId;
	}
					
}

?>