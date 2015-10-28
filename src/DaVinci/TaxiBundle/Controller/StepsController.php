<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\PassengerRequestRepository;
use DaVinci\TaxiBundle\Entity\PassengerRequestService;

use DaVinci\TaxiBundle\Entity\Payment\MakePayment;
use DaVinci\TaxiBundle\Entity\Payment\MakePaymentRepository;
use DaVinci\TaxiBundle\Entity\Payment\MakePaymentService;

use DaVinci\TaxiBundle\Form\PassengerRequest\CreatePassengerRequestFlow;

class StepsController extends Controller 
{
	
	const ACTION_BOOK_TRIP = 'book-trip';
	const ACTION_SHOW_OPEN_ORDERS = 'open-orders';
	const ACTION_SHOW_ALL_ORDERS = 'all-orders';
	
	protected function showSteps()
	{
		$sessionRequestId = $this->getRequest()->getSession()->get('request_id');
		$passengerRequest = $this->generatePassengerRequest();
		 
		$flow = $this->container->get('taxi.passengerRequest.form.flow');
		$flow->bind($passengerRequest);
				
		if (null !== $sessionRequestId) {
			$entity = $this->getFullPassengerRequestById($sessionRequestId);
			
			if (null !== $entity) {
				$passengerRequest = $entity;
			}
		}
		
		$form = $flow->createForm();
		if ($flow->isValid($form)) {
			if (CreatePassengerRequestFlow::STEP_LAST - 1 == $flow->getCurrentStepNumber()) {
				$this->savePassengerRequest($passengerRequest);
				$this->getRequest()->getSession()->set('request_id', $passengerRequest->getId());
			}
			$flow->saveCurrentStepData($form);
		
			if ($flow->nextStep()) {
				$form = $flow->createForm();
			} else {
				$isUser = $this->container->get('security.context')->isGranted('ROLE_USER');
				if ($isUser) {
					$passengerRequest->setUser(
						$this->container->get('security.context')->getToken()->getUser()
					);
				}
				
				$this->savePassengerRequest($passengerRequest);
								 
				$url = ($isUser)
					? $this->generateUrl('passenger_request_payment', array(
						'id' => $passengerRequest->getId()
					))
					: $this->generateUrl('fos_user_security_login');
				 
				$flow->reset();
		
				return $url;
			}
		}
		
		$data = array(
			'form' => $form->createView(),
			'flow' => $flow
		);
		
		if ($flow->getCurrentStepNumber() == CreatePassengerRequestFlow::STEP_THIRD) {
			$data['marketPrice'] = $this->getCalculationService()->getMarketPrice($passengerRequest);
			$data['marketTips'] = $this->getCalculationService()->getMarketTips($passengerRequest);
		}
		 
		return $data;
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
	 */
	protected function generatePassengerRequest()
	{
		return $this->getPassengerRequestService()->generateRequest();
	}
	
	/**
	 * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $request
	 * @return void
	 */
	protected function savePassengerRequest(\DaVinci\TaxiBundle\Entity\PassengerRequest $request)
	{
		$this->getPassengerRequestRepository()->saveAll($request);
	}
	
	/**
	 * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $request
	 * @return void
	 */
	protected function updatePassengerRequest(PassengerRequest $request)
	{
		$this->getPassengerRequestRepository()->save($request);
	}
	
	/**
	 * @param integer $id
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
	 */
	protected function getPassengerRequestById($id)
	{
		return $this->getPassengerRequestRepository()->find($id);
	}
	
	/**
	 * @param integer $id
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
	 */
	protected function getFullPassengerRequestById($id)
	{
		return $this->getPassengerRequestRepository()->getFullRequestById($id);
	}
	
	/**
	 * @param integer $id
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
	 */
	protected function getPassengerRequestWithDriversById($id)
	{
		return $this->getPassengerRequestRepository()->getRequestWithDriversById($id);
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequestService
	 */
	protected function getPassengerRequestService()
	{
		return $this->container->get('da_vinci_taxi.service.passenger_request_service');
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequestRepository
	 */
	protected function getPassengerRequestRepository()
	{
		$em = $this->container->get('doctrine')->getManager();
		return $em->getRepository('DaVinci\TaxiBundle\Entity\PassengerRequest');
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePaymentService
	 */
	protected function getMakePaymentService()
	{
		return $this->container->get('da_vinci_taxi.service.make_payment_service');
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePaymentRepository
	 */
	protected function getMakePaymentRepository()
	{
		$em = $this->container->get('doctrine')->getManager();
		return $em->getRepository('DaVinci\TaxiBundle\Entity\Payment\MakePayment');
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\IndependentDriverRepository
	 */
	protected function getIndependentDriverRepository()
	{
		$em = $this->container->get('doctrine')->getManager();
		return $em->getRepository('DaVinci\TaxiBundle\Entity\IndependentDriver');
	}
		
	/**
	 * @return \DaVinci\TaxiBundle\Services\Calculation
	 */
	protected function getCalculationService()
	{
		return $this->container->get('da_vinci_taxi.service.calculation_service');
	}
		
}

?>