<?php

namespace DaVinci\TaxiBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use DaVinci\TaxiBundle\Event\PassengerRequestEvents;
use DaVinci\TaxiBundle\Event\PassengerRequestEvent;
use DaVinci\TaxiBundle\Services\RemoteRequester;

class StockSubscriber implements EventSubscriberInterface 
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
			PassengerRequestEvents::CANCEL_REQUEST => array('onCancelPassengerRequest', 0)
		);
	}
	
	public function onCancelPassengerRequest(PassengerRequestEvent $event)
	{
		$request = $event->getPassengerRequest();
		$securityContext = $event->getSecurityContext();
		
		if ($securityContext->isGranted('ROLE_USER')) {
			$datetime = new \DateTime('+2 hours');
			
			if (0 == $datetime->diff($request->getPickUp())->invert && !$this->reversalFunds($event)) {
				return;
			}
			
			if (1 == $datetime->diff($request->getPickUp())->invert) {
				
			}
		}
				
		$request->cancelState();
		
		$repository = $event->getPassengerRequestRepository();
		$repository->saveAll($request);
	}
	
	private function reversalFunds(PassengerRequestEvent $event)
	{
		return $this->remoteRequester->makeOperation(
			$event->getPassengerRequest(), 
			RemoteRequester::OPCODE_INTERNAL_TRANSFER_MERCHANT_TO_USER
		);
	}
	
}

?>