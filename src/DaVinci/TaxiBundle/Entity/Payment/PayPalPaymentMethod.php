<?php

namespace DaVinci\TaxiBundle\Entity\Payment;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pay_pal_payment_method")
 */
class PayPalPaymentMethod extends CreditCardPaymentMethod 
{
	
	static public $subTypes = array();
	
}

?>