<?php

namespace DaVinci\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use DaVinci\TaxiBundle\Controller\StepsController;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\PassengerRequestRepository;
use DaVinci\TaxiBundle\Entity\PassengerRequestService;
use DaVinci\TaxiBundle\Entity\VehicleClasses;

use DaVinci\UserBundle\Form\Type\OfficePassengerProfileType;
use DaVinci\UserBundle\Form\Type\OfficeDriverProfileType;

class OfficeController extends StepsController
{
	
    /**
     * @Route("/choose-office", name="fos_user_registration_confirmed")
     * @Method("GET")
     * @Security("has_role('ROLE_USER') or has_role('ROLE_TAXIDRIVER') or has_role('ROLE_COMPANYDRIVER') or has_role('ROLE_TAXIMANAGER') or has_role('ROLE_TAXICOMPANY')")
     */
    public function office_chooseAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_choose.html.twig');
    }
    
    /**
     * @Route("/office-company", name="office_company")
     * @Security("has_role('ROLE_TAXICOMPANY')")
     */
    public function office_companyAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_company.html.twig');
    }

    /**
     * @Route("/office-manager-company", name="office_manager_company")
     * @Security("has_role('ROLE_TAXICOMPANY')")
     */
    public function office_manager_companyAction()
    {
        return $this->render('DaVinciUserBundle:Offices:office_manager_company.html.twig');
    }

    /**
     * @Route("/office-passenger-profile", name="office_passenger_profile")
     * @Security("has_role('ROLE_USER')")
     */
    public function office_passenger_profileAciton(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (empty($user)) {
            throw new NotFoundHttpException(sprintf('There is empty user, try login'));
        }
       
        $isPassExp = !$user->isPasswordNotExpired();
         
        $form = $this->createForm(new OfficePassengerProfileType(), $user);
        if ('POST' === $request->getMethod()) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $usr = $form->getData();
               
                $pass = $form['current_password']->getData();
                // set new password if added
                if (!empty($pass)) {
                    $user->setPlainPassword($form['new']->getData());
                }
                $this->container->get('fos_user.user_manager')->updateUser($usr);
                
                return new \Symfony\Component\HttpFoundation\Response('success', 200);
            }
        }
        
        
        return $this->container->get('templating')->renderResponse(
        	'DaVinciUserBundle:Offices:office_passenger_profile_edit_form.html.twig', array(
				'form' => $form->createView(),
                'isPasswordExpired' => $isPassExp
        	)
        );
    }
    
    
    /**
     * @Route("/office-passenger/{method}", name="office_passenger", defaults={"method" = "book-trip"})
     * @Security("has_role('ROLE_USER')")
     */
    public function officePassengerAction(Request $request)
    {
    	$user = $this->get('security.context')->getToken()->getUser();
    	if (is_null($user)) {
    		return new RedirectResponse(
                $this->get('router')->generate('fos_user_security_login')
            );
    	}
    	
    	$subMethod = $request->get('method');
    	$result = $this->showSteps();
    	if (!is_array($result)) {
    		return $this->redirect($result);
    	}
    	    	
    	$userRequests = $this->getPassengerRequestRepository()->getAllActualUserRequestsByStates(
    		$user->getId(),
    		array(
    			PassengerRequest::STATE_BEFORE_OPEN,
    			PassengerRequest::STATE_OPEN,
    			PassengerRequest::STATE_PENDING
    		)
    	);
    	
    	$params = array(
    		'subMethod' => $subMethod,
    		'openRequestsNumber' => count($userRequests),
            'user' => $user
    	);    	
    	
    	if (self::ACTION_SHOW_OPEN_ORDERS == $subMethod) {
    		$params['requests'] = $userRequests;
	    }
    	
    	if (self::ACTION_SHOW_ALL_ORDERS == $subMethod) {
    		$params['requests'] = $this->getPassengerRequestRepository()->getAllUserRequests(
    			$user->getId()
    		);
    	}
            	
        return $this->get('templating')->renderResponse(
        	'DaVinciUserBundle:Offices:office_passenger.html.twig', 
        	array_merge($params, $result)
		);
    }

    // this doesn't work yet...
    // @Security("has_role('ROLE_TAXIDRIVER')", message="You have to be logged in as a driver")
    /**
     * @Route("/office-driver-profile", name="office_driver_profile")
     */
    public function officeDiverProfileAciton(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            if (!$this->get('security.context')->isGranted('ROLE_TAXIDRIVER')) {
                throw new AccessDeniedException('You have to be logged in as a driver');
            }

            $user = $this->get('security.context')->getToken()->getUser();
            if (null === $user || !is_object($user)) {
                throw new NotFoundHttpException(sprintf('There is empty user, try login'));
            }

            $form = $this->createForm(
                new OfficeDriverProfileType(), $user->getIndependentDriver()
            );
            $form->get('user')->setData($user);

            if ('POST' === $request->getMethod()) {
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $data = $form->getData();
                    $this->get('fos_user.user_manager')->updateUser($data->getUser());

                    return new Response('success', 200);
                }
            }

            return $this->get('templating')->renderResponse(
            	'DaVinciUserBundle:Offices:office_driver_profile_edit_form.html.twig', 
            	array('form' => $form->createView())
            );
        } else {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
    }
    
    /**
     * @Route("/office-driver/{method}", name="office_driver", defaults={"method" = "find"})
     */
    public function officeDriverAction($method)
    {
        if (!$this->get('security.context')->isGranted('ROLE_TAXIDRIVER')) {
            throw new AccessDeniedException('You have to be logged in as a driver');
        }
        
        $driverRepository = $this
        	->get('doctrine')
        	->getManager()
        	->getRepository('DaVinci\TaxiBundle\Entity\IndependentDriver');
        
        $driver = $driverRepository->findOneByUserId(
        	$this->get('security.context')->getToken()->getUser()->getId()
        );
        
        return $this->get('templating')->renderResponse(
        	'DaVinciUserBundle:Offices:office_driver.html.twig',
        	array(
        		'openRequests' => $this->getStockRequests(),
                'vehicleClasses' => VehicleClasses::getFilterChoices(),
           		'driver' => $driver,
                'method' => $method
        	)
        );        
    }

    /**
     * @Route("/block-profile", name="block_profile")
     * @Security("has_role('ROLE_USER')")
     */
    public function block_profileAction()
    {
        return $this->render('DaVinciUserBundle:Offices:block_profile.html.twig');
    }
    
    /**
     * @Route("/filter-table", name="filter_table")
     * @Security("has_role('ROLE_USER')")
     */   
    public function filter_tableAction()
    {
        return $this->render('DaVinciUserBundle:Home:filter_table.html.twig');
    }

    /**
     * @Route("/order-table", name="order_table")
     * @Security("has_role('ROLE_USER')")
     */   
    public function order_tableAction()
    {
        return $this->render('DaVinciUserBundle:Offices:order_table.html.twig');
    }
    
    /**
     * @Route("/dispet-table", name="dispet_table")
     * @Security("has_role('ROLE_USER')")
     */      
    public function dispet_tableAction()
    {
        return $this->render('DaVinciUserBundle:Offices:dispet_table.html.twig');
    }
        
}
