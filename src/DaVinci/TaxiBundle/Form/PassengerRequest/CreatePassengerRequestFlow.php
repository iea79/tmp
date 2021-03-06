<?php

namespace DaVinci\TaxiBundle\Form\PassengerRequest;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

use Craue\FormFlowBundle\Form\FormFlowEvents;
use Craue\FormFlowBundle\Event\PreBindEvent;
use Craue\FormFlowBundle\Event\GetStepsEvent;
use Craue\FormFlowBundle\Event\PostBindSavedDataEvent;
use Craue\FormFlowBundle\Event\PostBindFlowEvent;
use Craue\FormFlowBundle\Event\PostBindRequestEvent;
use Craue\FormFlowBundle\Event\PostValidateEvent;

use DaVinci\TaxiBundle\Form\PassengerRequest\Type\RouteInfoType;
use DaVinci\TaxiBundle\Form\PassengerRequest\Type\VehicleInfoType;
use DaVinci\TaxiBundle\Form\PassengerRequest\Type\PassengerInfoType;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CreatePassengerRequestFlow extends FormFlow implements EventSubscriberInterface 
{
	
	const FLOW_NAME = 'createPassengerRequest';
	
	const STEP_FIRST = 1;
	const STEP_SECOND = 2;
	const STEP_LAST = 3;
    	
	public function getName() 
	{
		return self::FLOW_NAME;
	}
	
	public static function getSubscribedEvents() 
	{
		return array(
			FormFlowEvents::PRE_BIND => 'onPreBind',
			FormFlowEvents::GET_STEPS => 'onGetSteps',
			FormFlowEvents::POST_BIND_SAVED_DATA => 'onPostBindSavedData',
			FormFlowEvents::POST_BIND_FLOW => 'onPostBindFlow',
			FormFlowEvents::POST_BIND_REQUEST => 'onPostBindRequest',
			FormFlowEvents::POST_VALIDATE => 'onPostValidate'
		);
	}
	
	public function setEventDispatcher(EventDispatcherInterface $dispatcher) 
	{
		parent::setEventDispatcher($dispatcher);
		$dispatcher->addSubscriber($this);
	}
	
	public function onPreBind(PreBindEvent $event) 
	{
		
	}
	
	public function onGetSteps(GetStepsEvent $event)
	{
		
	}
	
	public function onPostBindSavedData(PostBindSavedDataEvent $event) 
	{
		
	}
	
	public function onPostBindFlow(PostBindFlowEvent $event)
	{
		if ($event->getFlow()->getCurrentStepNumber() == CreatePassengerRequestFlow::STEP_FIRST) {
			$request = $event->getFormData();
			
			$routePoints = $request->getRoutePoints();
			$iterator = $routePoints->getIterator();
		
			$count = 0;
			$iterator->rewind();
			while ($iterator->valid()) {
				if ($count < 2) {
					$iterator->next();
					$count++;
		
					continue;
				}
		
				if ('' == trim($iterator->current()->getPlace())) {
					$request->removeRoutePoint($iterator->current());
				}
					
				$iterator->next();
				$count++;
			}
		}
	}
	
	public function onPostBindRequest(PostBindRequestEvent $event) 
	{
		
	}
	
	public function onPostValidate(PostValidateEvent $event) 
	{
		if ($event->getFlow()->getCurrentStepNumber() == self::STEP_LAST) {
			$request = $event->getFormData();
			
			$vehicleOptions = $request->getVehicleOptions();
			
			foreach ($vehicleOptions->getChildSeats() as $seat) {
				if ($seat->getChildSeatNumber() <= 0) {
					$vehicleOptions->removeChildSeat($seat);
				}
			}
			
			foreach ($vehicleOptions->getPetCages() as $cage) {
				if ($cage->getPetCageNumber() <= 0) {
					$vehicleOptions->removePetCage($cage);
				}
			}
		
			$request->setPickUp(new \DateTime(
				$request->getPickUpDate()->format('Y-m-d') . ' ' 
					. $request->getPickUpTime()->format('H:i:s')
			));
			
			if ($request->getRoundTrip()) {
				$request->setReturn(new \DateTime(
					$request->getReturnDate()->format('Y-m-d') . ' ' 
						. $request->getReturnTime()->format('H:i:s')
				));
			}
			
			$tariff = $request->getTariff();
			$tariff->definePrice();
			$tariff->defineTips();
		}
	}
		
	protected function loadStepsConfig()
	{
		return array(
			array(
				'label' => 'routeInfo',
				'type' => new RouteInfoType()
			),
			array(
				'label' => 'vehicleInfo',
				'type' => new VehicleInfoType()
			),
			array(
				'label' => 'passengerInfo',
				'type' => new PassengerInfoType()
			)
		);
	}
    			
}

?>