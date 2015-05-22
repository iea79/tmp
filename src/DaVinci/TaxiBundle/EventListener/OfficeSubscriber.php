<?php

namespace DaVinci\TaxiBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use DaVinci\TaxiBundle\Services\RemoteRequester;

use DaVinci\TaxiBundle\Event\FinancialOfficeEvents;
use DaVinci\TaxiBundle\Event\TransferOperationEvent;

class OfficeSubscriber implements EventSubscriberInterface 
{
	
	/**
	 * @var \DaVinci\TaxiBundle\Services\RemoteRequester
	 */
	private $remoteRequester;
	
	public function __construct(RemoteRequester $requester)
	{
		$this->remoteRequester = $requester;
	}
	
	public static function getSubscribedEvents()
	{
		return array(
			FinancialOfficeEvents::TRANSFER_OPERATION => array('onTransferOperation', 0)
		);
	}
	
	public function onTransferOperation(TransferOperationEvent $event)
	{
		$makePayment = $event->getMakePayment();
		
		$paymentMethod = $makePayment->getPaymentMethod();
		$paymentMethod->addMakePayment($makePayment);
		 
		$makePayment->setPaymentMethod($paymentMethod);
		$makePayment->setDefaultTotalPrice();
		$makePayment->setUser(
			$event->getSecurityContext()
				->getToken()
				->getUser()
		);
		
		$event->getMakePaymentRepository()->save($makePayment);
	}
	
}

?>