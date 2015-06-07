<?php

namespace DaVinci\TaxiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use DaVinci\TaxiBundle\Entity\Payment\MakePayments;
use DaVinci\TaxiBundle\Entity\Payment\MakePaymentService;
use DaVinci\TaxiBundle\Entity\Payment\PaymentMethod;

use DaVinci\TaxiBundle\Event\FinancialOfficeEvents;
use DaVinci\TaxiBundle\Event\TransferOperationEvent;
use DaVinci\TaxiBundle\Services\RemoteRequesterException;

class InformationController extends StepsController {
	
	const ACTION_OFFICE_ADD = 'add';
	const ACTION_OFFICE_TRANSFER = 'transfer';

    public function profitAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        
        $driverTabs = $dm->getRepository('DaVinciTaxiBundle:ProfitPage')->getDriverProfitTab();
        $passengerTabs= $dm->getRepository('DaVinciTaxiBundle:ProfitPage')->getPassengerProfitTab();
        
        return $this->render(
        	'DaVinciTaxiBundle:Information:profit.html.twig',
            array(
            	'driver_tabs' => $driverTabs,
                'passenger_tabs' => $passengerTabs
        	)
        );
    }

    public function aboutAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $allTabs= $dm->getRepository('DaVinciTaxiBundle:AboutPage')->findAll();
        
        return $this->render('DaVinciTaxiBundle:Information:about.html.twig',
                array(
                    'all_tabs' => $allTabs,
                ));
    }

    public function helpAction()
    {
        return $this->render('DaVinciTaxiBundle:Information:help.html.twig');
    }

    public function view_officesAction()
    {
        return $this->render('DaVinciTaxiBundle:Information:view_offices.html.twig');
    }

    public function video_guidesAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $allVideos= $dm->getRepository('DaVinciTaxiBundle:VideoGuidesPage')->findBy(array('publishable' => true));
            
        return $this->render('DaVinciTaxiBundle:Information:videos.html.twig',
                array(
                    'videos' => $allVideos,
                ));
    }

    public function videoAction($contentDocument)
    {
         return $this->render('DaVinciTaxiBundle:Information:video.html.twig',
                array(
                    'page' => $contentDocument,
                ));
    }    
    
    
    public function guideAction($contentDocument)
    {
         return $this->render('DaVinciTaxiBundle:Information:guide.html.twig',
                array(
                    'page' => $contentDocument,
                ));
    }
    
    public function guidesAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $allGuides= $dm->getRepository('DaVinciTaxiBundle:GuidesPage')->findBy(array('publishable' => true));
            
        return $this->render('DaVinciTaxiBundle:Information:guides.html.twig',
                array(
                    'guides' => $allGuides,
                ));
    }

    public function one_helpAction()
    {
        return $this->render('DaVinciTaxiBundle:Information:one_help.html.twig');
    }

    public function FAQsAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $allFaqs= $dm->getRepository('DaVinciTaxiBundle:FaqEntry')->findBy(array('published' => true));
            
        return $this->render('DaVinciTaxiBundle:Information:FAQs.html.twig',
                array(
                    'faqs' => $allFaqs,
                ));
    }

    public function notificationsAction()
    {
        return $this->render('DaVinciTaxiBundle:Notifications:notifications.html.twig');
    }

    public function new_ticketAction()
    {
        return $this->render('DaVinciTaxiBundle:Notifications:new_ticket.html.twig');
    }

    public function socialAction()
    {
        return $this->render('DaVinciTaxiBundle:Information:info.html.twig',
                array(
                    'social' => true,
                    'reviews' => false,
                    'isblog' => false
                ));
    }
    
    public function reviewsAction()
    {
        return $this->render(
        	'DaVinciTaxiBundle:Information:info.html.twig',
            array(
            	'reviews' => true,
                'social' => false,
                'isblog' => false
        	)
        );
    }

    /**
     * @Route("/financial-office/add/{methodCode}", name="financial_office_add", defaults={"methodCode" = "2_1"})
     * @Security("has_role('ROLE_USER')")
     */
    public function financialOfficeAddAction(Request $request, $methodCode)
    {
    	return $this->showOffice(self::ACTION_OFFICE_ADD, $request, $methodCode);
    }
    
    /**
     * @Route("/financial-office/withdraw/{methodCode}", name="financial_office_withdraw", defaults={"methodCode" = "credit-card"})
     * @Security("has_role('ROLE_USER')")
     */
    public function financialOfficeWithdrawAction($methodCode)
    {
    	return $this->render(
    		'DaVinciTaxiBundle:Finoffice:financial_office.html.twig',
    		array(
    			'action' => 'withdraw',
    			'methodCode' => $methodCode
    		)
    	);
    }
    
    /**
     * @Route("/financial-office/transfer/{methodCode}", name="financial_office_transfer", defaults={"methodCode" = "1_1"})
     * @Security("has_role('ROLE_USER')")
     */
    public function financialOfficeTransferAction(Request $request, $methodCode)
    {
    	return $this->showOffice(self::ACTION_OFFICE_TRANSFER, $request, $methodCode);
    }
    
    /**
     * @Route("/financial-office/history", name="financial_office_history")
     * @Security("has_role('ROLE_USER')")
     */
    public function financialOfficeHistoryAction()
    {
    	return $this->render(
    		'DaVinciTaxiBundle:Finoffice:financial_office.html.twig',
    		array(
    			'action' => 'history'
    		)	
    	);
    }
    
    public function storeAction()
    {
        return $this->render('DaVinciTaxiBundle:Store:store.html.twig');
    }
    
    public function sale_pageAction()
    {
        return $this->render('DaVinciTaxiBundle:Store:sale_page.html.twig');
    }

    public function letter_confirmAction()
    {
        return $this->render('DaVinciTaxiBundle:Email:letter_confirm.html.twig');
    }
    
    private function showOffice($action, Request $request, $methodCode)
    {
    	$makePaymentService = $this->getMakePaymentService();
    	$makePayment = $makePaymentService->createConfigured($request);
    	
    	$form = $this->createForm(
    		$makePaymentService->createPaymentMethodFormType($request),
    		$makePayment
    	);
    	
    	$result = array();
    	
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		try {
	    		$dispatcher = $this->container->get('event_dispatcher');
	    		$dispatcher->dispatch(
	    			FinancialOfficeEvents::OPERATION_ADD,
	    			new TransferOperationEvent(
	    				$form->getData(),
	    				$this->getMakePaymentRepository(),
	    				$this->container->get('security.context'),
	    				MakePayments::DEFAULT_DESCRIPTION_SETTLE_ACCCOUNT	
	    			)
	    		);
	    		
	    		$result['operationCode'] = MakePayments::CODE_SUCCESS;
    		} catch (RemoteRequesterException $exception) {
    			$result['operationCode'] = MakePayments::CODE_FAIL;
    		}
    	}
    	 
    	return $this->render(
    		'DaVinciTaxiBundle:Finoffice:financial_office.html.twig',
    		array_merge(
    			array(
    				'action' => $action,
    				'form' => $form->createView(),
    				'paymentMethod' => $makePayment->getPaymentMethod()->getType(),
    				'subType' => $makePayment->getPaymentMethod()->getSubTypeName(),
    				'methodCode' => $methodCode,
    				'methods' => MakePaymentService::generateMethods(PaymentMethod::POS_INTERNAL_PAYMENT_METHOD)    						
    			),
    			$result	
    		)	 
    	);
    }
        
}
