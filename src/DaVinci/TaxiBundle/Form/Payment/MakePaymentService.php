<?php

namespace DaVinci\TaxiBundle\Form\Payment;

class MakePaymentService 
{
	/**
	 * @return \DaVinci\TaxiBundle\Form\Payment\MakePayment
	 */
	public function create()
	{
		return new MakePayment();
	}
	
}

?>