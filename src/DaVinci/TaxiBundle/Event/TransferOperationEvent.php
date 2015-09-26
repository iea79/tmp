<?php

namespace DaVinci\TaxiBundle\Event;

use Symfony\Component\EventDispatcher\Event;

use DaVinci\TaxiBundle\Entity\Payment\MakePayment;
use DaVinci\TaxiBundle\Entity\Payment\MakePaymentRepository;

class TransferOperationEvent extends Event
{

	/**
	 * @var \DaVinci\TaxiBundle\Entity\Payment\MakePayment
	 */
	protected $makePayment;
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\Payment\MakePaymentRepository
	 */
	protected $makePaymentRepository;
	
	/**
	 * @var string
	 */
	protected $description;
    
    /**
	 * @var string
	 */
	protected $operationType;
	
	public function __construct(
		MakePayment $makePayment,
		MakePaymentRepository $makePaymentRepository,
		$description,
        $operationType
	) {
		$this->makePayment = $makePayment;
		$this->makePaymentRepository = $makePaymentRepository;
		$this->description = $description;
        $this->operationType = $operationType;
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePayment
	 */
	public function getMakePayment()
	{
		return $this->makePayment;
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePaymentRepository
	 */
	public function getMakePaymentRepository()
	{
		return $this->makePaymentRepository;
	}
	
    /**
     * return string
     */
	public function getDescription()
	{
		return $this->description;
	}
    
    /**
     * return string
     */
    public function getOperationType()
    {
        return $this->operationType;
    }    
	
}

?>