<?php

namespace DaVinci\TaxiBundle\Entity\Payment;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="internal_payment_method")
 */
class InternalPaymentMethod extends PaymentMethod
{
	
	const POS_BALANCE_TYPE_PRIVATE = 1;
	const POS_BALANCE_TYPE_BUSINESS = 2;
	
	const BALANCE_TYPE_PRIVATE = 'Private';
	const BALANCE_TYPE_BUSINESS = 'Business';
	
	/**
	 * @ORM\Column(type="string", length=100, nullable=true)
	 */
	protected $accountId;
		
	static public $subTypes = array(
		self::POS_BALANCE_TYPE_PRIVATE => self::BALANCE_TYPE_PRIVATE,
		self::POS_BALANCE_TYPE_BUSINESS => self::BALANCE_TYPE_BUSINESS
	);
	
    /**
     * Set accountId
     *
     * @param string $accountId
     *
     * @return InternalPaymentMethod
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get accountId
     *
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

}

?>