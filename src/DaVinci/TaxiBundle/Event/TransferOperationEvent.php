<?php

namespace DaVinci\TaxiBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Security\Core\SecurityContext;

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
	 * @var \Symfony\Component\Security\Core\SecurityContext
	 */
	protected $securityContext;
	
	/**
	 * @var description
	 */
	protected $description;
	
	public function __construct(
		MakePayment $makePayment,
		MakePaymentRepository $makePaymentRepository,
		SecurityContext $securityContext,
		$description
	) {
		$this->makePayment = $makePayment;
		$this->makePaymentRepository = $makePaymentRepository;
		$this->securityContext = $securityContext;
		$this->description = $description; 		
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
	 * @return \Symfony\Component\Security\Core\SecurityContext
	 */
	public function getSecurityContext()
	{
		return $this->securityContext;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	
}

?>