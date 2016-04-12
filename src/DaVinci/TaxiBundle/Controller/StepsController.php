<?php

namespace DaVinci\TaxiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use DaVinci\TaxiBundle\Entity\User;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\PassengerRequestRepository;
use DaVinci\TaxiBundle\Entity\PassengerRequestService;

use DaVinci\TaxiBundle\Entity\Payment\MakePayment;
use DaVinci\TaxiBundle\Entity\Payment\MakePaymentRepository;
use DaVinci\TaxiBundle\Entity\Payment\MakePaymentService;

use DaVinci\TaxiBundle\Form\PassengerRequest\CreatePassengerRequestFlow;

class StepsController extends Controller 
{
    
    use SeoTrait;
	
	const ACTION_BOOK_TRIP = 'book-trip';
	const ACTION_SHOW_OPEN_ORDERS = 'open-orders';
	const ACTION_SHOW_ALL_ORDERS = 'all-orders';
    
    public function render($view, array $parameters = array(), Response $response = null) {
        if (!is_null($this->getParams())) {
            $parameters['seoParams'] = $this->getParams();
        }
        
        return parent::render($view, $parameters, $response);
    }
    
    protected function showSteps()
	{
        $passengerRequest = $this
                                ->getPassengerRequestService()
                                ->generateRequest();
        
        $flow = $this->get('taxi.passengerRequest.form.flow');
		$flow->bind($passengerRequest);
                		
        $form = $flow->createForm();
        if ($flow->isValid($form)) {
			$flow->saveCurrentStepData($form);
		
			if ($flow->nextStep()) {
				$form = $flow->createForm();
			} else {
				$isUser = $this->get('security.context')->isGranted('ROLE_USER');
				if ($isUser) {
					$passengerRequest->setUser(
						$this->get('security.context')->getToken()->getUser()
					);
				}
				
				$this->savePassengerRequest($passengerRequest);
                $this->getRequest()->getSession()->set('request_id', $passengerRequest->getId());
								 
				$url = ($isUser)
					? $this->generateUrl('passenger_request_confirm', array(
						'id' => $passengerRequest->getId()
					))
					: $this->generateUrl('fos_user_security_login');
				 
				$flow->reset();
		
				return $url;
			}
		}
		
		$data = array(
			'form' => $form->createView(),
			'flow' => $flow,
            'passengerRequest' => $passengerRequest
		);
		
		if ($flow->getCurrentStepNumber() == CreatePassengerRequestFlow::STEP_LAST) {
			$data['marketPrice'] = $this->getCalculationService()->getMarketPrice($passengerRequest);
			$data['marketTips'] = $this->getCalculationService()->getMarketTips($passengerRequest);
		}
		 
		return $data;
	}
    
    protected function getActualUser()
    {
        $user = null;
        if ($this->get('security.context')->isGranted('ROLE_TAXIDRIVER')) {
            $driverRepository = $this
                ->get('doctrine')
                ->getManager()
                ->getRepository('DaVinci\TaxiBundle\Entity\IndependentDriver');

            $user = $driverRepository->findOneByUserId(
                $this->get('security.context')->getToken()->getUser()->getId()
            );                
        } else if ($this->get('security.context')->isGranted('ROLE_USER')) {
            $user = $this->get('security.context')->getToken()->getUser();
        }
        
        return $user;
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
	 * @param \DaVinci\TaxiBundle\Entity\User $user
     * @param integer $id
     * @param array $states
     * @return \DaVinci\TaxiBundle\Entity\PassengerRequest
	 */
	protected function getFullPassengerRequestForUserById(User $user, $id, array $states = array())
	{
        return $this->getPassengerRequestRepository()->getFullRequestForUserById(
            $user, $id, $states
        );
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
		return $this->get('da_vinci_taxi.service.passenger_request_service');
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\PassengerRequestRepository
	 */
	protected function getPassengerRequestRepository()
	{
		$em = $this->get('doctrine')->getManager();
		return $em->getRepository('DaVinci\TaxiBundle\Entity\PassengerRequest');
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePaymentService
	 */
	protected function getMakePaymentService()
	{
		return $this->get('da_vinci_taxi.service.make_payment_service');
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePaymentRepository
	 */
	protected function getMakePaymentRepository()
	{
		$em = $this->get('doctrine')->getManager();
		return $em->getRepository('DaVinci\TaxiBundle\Entity\Payment\MakePayment');
	}
	
	/**
	 * @return \DaVinci\TaxiBundle\Entity\IndependentDriverRepository
	 */
	protected function getIndependentDriverRepository()
	{
		$em = $this->get('doctrine')->getManager();
		return $em->getRepository('DaVinci\TaxiBundle\Entity\IndependentDriver');
	}
		
	/**
	 * @return \DaVinci\TaxiBundle\Services\Calculation
	 */
	protected function getCalculationService()
	{
		return $this->get('da_vinci_taxi.service.calculation_service');
	}
    
    /**
     * @param integer $driverId
     * @return \DaVinci\TaxiBundle\Entity\GeneralDriver
     */
    protected function getDirverById($driverId)
    {
    	return $this->getIndependentDriverRepository()->find($driverId);
    }
    
    /**
     * @param integer $userId
     * @return \DaVinci\TaxiBundle\Entity\GeneralDriver
     */
    protected function getDirverByUserId($userId)
    {
    	return $this->getIndependentDriverRepository()->findOneByUserId($userId);
    }
        
    /**
     * @return array
     */
    protected function getStockRequests(array $states = array())
    {
        if (!count($states)) {
            $states = array(
                PassengerRequest::STATE_OPEN,
                PassengerRequest::STATE_PENDING,
                PassengerRequest::STATE_SOLD
            );
        }
        
        if ($this->get('security.context')->isGranted('ROLE_TAXIDRIVER')) {
            $user = $this->get('security.context')
                ->getToken()
                ->getUser();

            $driver = $this->getDirverByUserId($user->getId());
            if ($driver && !is_null($driver->getVehicle())) {
                return $this
                    ->getPassengerRequestRepository()
                    ->getDriverActualRequestsByStates($driver, $states);
            }           
        } 
            
        return $this
                    ->getPassengerRequestRepository()
                    ->getActualRequestsByStates($states);
    }  

    // Payment page steps 
    public function payPageStepsAction()
    {
        return $this->render('DaVinciTaxiBundle:Store:payment_step_page.html.twig');
    }

}

?>