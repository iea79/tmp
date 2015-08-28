<?php

namespace DaVinci\TaxiBundle\Entity\Payment;

final class MakePayments 
{
	
	const FLOW_NAME = 'makePayment';
	const PAYMENT_INFO_TYPE = 'PaymentInfoType';

	const COMISSION = 0.15;
	
	const DEFAULT_REQUEST_PRICE = 1.00;
	const DEFAULT_CURRENCY = 'USD';
	
	const DEFAULT_DESCRIPTION_SETTLE_ACCCOUNT = 'Settle account';
	
	const CODE_SUCCESS = 0;
	const CODE_FAIL = 9999;
			
}

?>