<?php

namespace DaVinci\TaxiBundle\Form\Payment;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;
use Craue\FormFlowBundle\Form\FormFlowEvents;

use Craue\FormFlowBundle\Event\PreBindEvent;
use Craue\FormFlowBundle\Event\GetStepsEvent;
use Craue\FormFlowBundle\Event\PostBindSavedDataEvent;
use Craue\FormFlowBundle\Event\PostBindFlowEvent;
use Craue\FormFlowBundle\Event\PostValidateEvent;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use DaVinci\TaxiBundle\Form\Payment\Type\PaymentMethodType;
use DaVinci\TaxiBundle\Form\Payment\Type\CreditCardPaymentInfoType;
use DaVinci\TaxiBundle\Form\Payment\Type\SkrillPaymentInfoType;
use DaVinci\TaxiBundle\Form\Payment\Type\InternalPaymentInfoType;

use DaVinci\TaxiBundle\Entity\Payment\MakePayments;
use DaVinci\TaxiBundle\Entity\Payment\MakePaymentService;

class MakePaymentFlow extends FormFlow implements EventSubscriberInterface 
{
	
	const STEP_FIRST = 1;
	const STEP_SECOND = 2;
	
	public function getName() 
	{
		return MakePayments::FLOW_NAME;
	}
	
	public static function getSubscribedEvents() 
	{
		return array(
			FormFlowEvents::PRE_BIND => 'onPreBind',
			FormFlowEvents::GET_STEPS => 'onGetSteps',
			FormFlowEvents::POST_BIND_SAVED_DATA => 'onPostBindSavedData',
			FormFlowEvents::POST_BIND_FLOW => 'onPostBindFlow',
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
	
	public function onPostBindSavedData(PostBindSavedDataEvent $event) {
		
	}
	
	public function onPostValidate(PostValidateEvent $event) 
	{
			
	}
	
	public function onPostBindFlow(PostBindFlowEvent $event)
	{
		
	}
	
	protected function loadStepsConfig()
	{
		return array(
			array(
				'label' => 'paymentMethod',
				'type' => new PaymentMethodType()
			),
			array(
				'label' => 'paymentInfo',
				'type' => $this->createFormType()	
			)			
		);
	}
	
	private function createFormType()
	{
		return MakePaymentService::createPaymentMethodFormType(
			$this->getRequest()
		);
	}
		
}

?>