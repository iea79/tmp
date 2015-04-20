<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\PassengerRequestRepository;
use DaVinci\TaxiBundle\Entity\PassengerRequestService;
use DaVinci\TaxiBundle\Form\PassengerRequest\CreatePassengerRequestFlow;

class StepsController extends Controller 
{
	
	protected function showSteps()
	{
		$passengerRequest = $this->spawnPassengerRequest();
		 
		$flow = $this->container->get('taxi.passengerRequest.form.flow');
		$flow->bind($passengerRequest);
		 
		$form = $flow->createForm();
		if ($flow->isValid($form)) {
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
				
				$this->createPassengerRequest($passengerRequest);
				$this->getRequest()->getSession()->set('request_id', $passengerRequest->getId());
				 
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
	protected function spawnPassengerRequest()
	{
		return $this->getPassengerRequestService()->spawnRequest();
	}
	
	/**
	 * @param \DaVinci\TaxiBundle\Entity\PassengerRequest $request
	 * @return void
	 */
	protected function createPassengerRequest(\DaVinci\TaxiBundle\Entity\PassengerRequest $request)
	{
		$em = $this->container->get('doctrine')->getManager();
		$em->getRepository('DaVinci\TaxiBundle\Entity\PassengerRequest')->create($request);
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequestService
	 */
	protected function getPassengerRequestService()
	{
		return $this->container->get('da_vinci_taxi.service.passenger_request_service');
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