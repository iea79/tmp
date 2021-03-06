<?php

namespace DaVinci\TaxiBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\SecurityContext;

use DaVinci\TaxiBundle\Event\PassengerRequestEvents;
use DaVinci\TaxiBundle\Event\CommonDriverRequestEvent;
use DaVinci\TaxiBundle\Event\CancelRequestEvent;

use DaVinci\TaxiBundle\Services\Remote\RemoteRequester;
use DaVinci\TaxiBundle\Services\Remote\RequesterException;
use DaVinci\TaxiBundle\Services\Informer\InformerInterface;

use DaVinci\TaxiBundle\Entity\Tariff;
use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\User;
use DaVinci\TaxiBundle\Entity\Offices;

class StockSubscriber implements EventSubscriberInterface 
{
	
	/**
	 * @var \DaVinci\TaxiBundle\Services\Remote\RemoteRequester
	 */
	private $remoteRequester;
	
	/**
	 * @var \DaVinci\TaxiBundle\Services\Informer\InformerInterface
	 */
	private $informer;
	
	/**
	 * @var \Symfony\Component\Security\Core\SecurityContext
	 */
	private $securityContext;
	
	public function __construct(
		RemoteRequester $requester, 
		InformerInterface $informer,
		SecurityContext $securityContext
	) {
		$this->remoteRequester = $requester;
		$this->informer = $informer;
		$this->securityContext = $securityContext;
	}
	
	public static function getSubscribedEvents()
	{
		return array(
			PassengerRequestEvents::APPROVE_REQUEST => array('onApprovePassengerRequest', 0),
			PassengerRequestEvents::CANCEL_REQUEST => array('onCancelPassengerRequest', 0),
			PassengerRequestEvents::DECLINE_DRIVER_REQUEST => array('onDeclineDriverPassengerRequest', 0)
		);
	}
	
	public function onApprovePassengerRequest(CommonDriverRequestEvent $event)
	{
		$passengerRequest = $event->getPassengerRequest();
		$driver = $event->getDriver();
		
		if (
			PassengerRequest::STATE_PENDING == $passengerRequest->getStateValue()
    		&& Offices::RECIPIENT_USER == $event->getInitiatedBy()
		) {
			$passengerRequest->setDriver($driver);
			$passengerRequest->removeCanceledDrivers($driver);
		
			$driver->removeCanceledRequests($passengerRequest);
		}
		
		$passengerRequest->changeState();
		
		$driverRepository = $event->getDriverRepository();
		$driverRepository->save($driver);
				
		$passengerRequestRepository = $event->getPassengerRequestRepository();
		$passengerRequestRepository->saveAll($passengerRequest);
		
        if ($event->getInitiatedBy() == Offices::RECIPIENT_USER) {
            $this->informer->notify(
                $passengerRequest->getUser(), 
                PassengerRequestEvents::APPROVE_REQUEST,
                Offices::RECIPIENT_USER
            );
        }
        
        if ($event->getInitiatedBy() == Offices::RECIPIENT_TAXI_INDEPENDENT_DRIVER) {
            $this->informer->notify(
                $passengerRequest->getDriver()->getUser(), 
                PassengerRequestEvents::APPROVE_REQUEST,
                Offices::RECIPIENT_TAXI_INDEPENDENT_DRIVER
            );
        }
    }
	
	public function onDeclineDriverPassengerRequest(CommonDriverRequestEvent $event)
	{
        $passengerRequest = $event->getPassengerRequest();
		$driver = $event->getDriver();
	
		try {
			$this->processByUser($driver->getUser());
		} catch (RequesterException $exception) {
			return;
		}
	
		$passengerRequest->addCanceledDrivers($driver);
		$passengerRequest->removePossibleDriver($driver);
	
		if ($passengerRequest->getDriver() && $driver->getId() == $passengerRequest->getDriver()->getId()) {
			$passengerRequest->setDriver(null);
			$passengerRequest->resetToPendingState();
		}
	
		$driver->addCanceledRequests($passengerRequest);
		$driver->removePossibleRequests($passengerRequest);
	
		$driverRepository = $event->getDriverRepository();
		$driverRepository->save($driver);
		
		$passengerRequestRepository = $event->getPassengerRequestRepository();
		$passengerRequestRepository->saveAll($passengerRequest);
        
        if ($event->getInitiatedBy() == Offices::RECIPIENT_USER) {
            $this->informer->notify(
                $passengerRequest->getUser(), 
                PassengerRequestEvents::DECLINE_DRIVER_REQUEST,
                $event->getInitiatedBy()
            );
        }
	}
	
	public function onCancelPassengerRequest(CancelRequestEvent $event)
	{
		$passengerRequest = $event->getPassengerRequest();
			
        if (
            $event->getInitiatedBy() == Offices::RECIPIENT_USER
            && PassengerRequest::STATE_APPROVED_SOLD == $passengerRequest->getState()->getName()
        ) {
            $datetime = new \DateTime('+2 hours');
            $diff = $datetime->diff($passengerRequest->getPickUp());

            if (0 == $diff->invert) {
                try {
                    $this->processByPassengerRequest(
                        $passengerRequest, 
                        $passengerRequest->getDriver()->getUser()
                    );
                } catch (RequesterException $exception) {
                    return;
                }
            }

            if (
                1 == $diff->invert
                && Tariff::PAYMENT_METHOD_ESCROW == $passengerRequest->getTariff()->getPricePaymentMethod()
            ) {
                try {
                    $this->processByUser($passengerRequest->getUser());
                    $this->processByUser($passengerRequest->getDriver()->getUser());
                } catch (RequesterException $exception) {
                    return;
                }
            }

            $passengerRequest->cancelState();

            $repository = $event->getPassengerRequestRepository();
            $repository->saveAll($passengerRequest);

            $this->informer->notify(
                $passengerRequest->getUser(), 
                PassengerRequestEvents::CANCEL_REQUEST,
                $event->getInitiatedBy()
            );
        }
    }    
	
    private function processByPassengerRequest(PassengerRequest $passengerRequest, $recipient)
	{
		$this->remoteRequester->makePassengerRequestOperation(
			$passengerRequest, 
            RemoteRequester::OPCODE_INTERNAL_TRANSFER_MERCHANT_TO_USER,
            $recipient
		);
	}
	
	private function processByUser(User $user)
	{
		$this->remoteRequester->makeUserOperation(
			$user, RemoteRequester::OPCODE_INTERNAL_TRANSFER_MERCHANT_TO_USER
		);
	}
    
}