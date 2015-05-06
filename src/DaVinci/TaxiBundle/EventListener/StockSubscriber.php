<?php

namespace DaVinci\TaxiBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use DaVinci\TaxiBundle\Event\PassengerRequestEvents;
use DaVinci\TaxiBundle\Event\DeclineDriverRequestEvent;
use DaVinci\TaxiBundle\Event\CancelRequestEvent;
use DaVinci\TaxiBundle\Services\RemoteRequester;
use DaVinci\TaxiBundle\Entity\Tariff;
use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\User;

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
			PassengerRequestEvents::CANCEL_REQUEST => array('onCancelPassengerRequest', 0),
			PassengerRequestEvents::DECLINE_DRIVER_REQUEST => array('onDeclineDriverPassengerRequest', 0)
		);
	}
	
	public function onCancelPassengerRequest(CancelRequestEvent $event)
	{
		$passengerRequest = $event->getPassengerRequest();
		$securityContext = $event->getSecurityContext();
		
		if (
			$securityContext->isGranted('ROLE_USER')
			&& PassengerRequest::STATE_APPROVED_SOLD == $passengerRequest->getState()->getName()
		) {
			$datetime = new \DateTime('+2 hours');
			
			if (
				0 == $datetime->diff($passengerRequest->getPickUp())->invert
				&& !$this->makeTransferByRequest($passengerRequest)
			) {
				return;
			}
			
			if (
				1 == $datetime->diff($passengerRequest->getPickUp())->invert
				&& Tariff::PAYMENT_METHOD_ESCROW == $passengerRequest->getTariff()->getPricePaymentMethod()
				&& (
					!$this->makeTransferByUser($passengerRequest->getUser())
					|| !$this->makeTransferByUser($passengerRequest->getDriver()->getUser())
				)		
			) {
				return;
			}
		}
				
		$passengerRequest->cancelState();
		
		$repository = $event->getPassengerRequestRepository();
		$repository->saveAll($passengerRequest);
	}
	
	public function onDeclineDriverPassengerRequest(DeclineDriverRequestEvent $event)
	{
		$passengerRequest = $event->getPassengerRequest();
		$driver = $event->getDriver();
		$informer = $event->getInformer();

		$this->makeTransferByUser($driver->getUser());
		
		$passengerRequest->addCanceledDrivers($driver);
		$passengerRequest->removePossibleDriver($driver);
		
		if ($passengerRequest->getDriver() && $driver->getId() == $passengerRequest->getDriver()->getId()) {
			$passengerRequest->setDriver(null);
			$passengerRequest->resetToPendingState();
		}
		
		$driver->addCanceledRequests($passengerRequest);
		$driver->removePossibleRequests($passengerRequest);
		 
		$informer->notify($driver->getUser(), 'decline');
		 
		$passengerRequestRepository = $event->getPassengerRequestRepository();
		$passengerRequestRepository->saveAll($passengerRequest);
		
		$driverRepository = $event->getDriverRepository();
		$driverRepository->save($driver);
	}
	
	private function makeTransferByRequest(PassengerRequest $passengerRequest)
	{
		return $this->remoteRequester->makeOperation(
			$passengerRequest, 
			RemoteRequester::OPCODE_INTERNAL_TRANSFER_MERCHANT_TO_USER
		);
	}
	
	private function makeTransferByUser(User $user)
	{
		return $this->remoteRequester->makeUserOperation(
			$user, RemoteRequester::OPCODE_INTERNAL_TRANSFER_MERCHANT_TO_USER
		);	
	}
	
}

?>