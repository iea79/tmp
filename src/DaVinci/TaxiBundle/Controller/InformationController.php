<?php

namespace DaVinci\TaxiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use DaVinci\TaxiBundle\Entity\UserComment;
use DaVinci\TaxiBundle\Entity\Payment\MakePayments;
use DaVinci\TaxiBundle\Entity\Payment\MakePaymentService;
use DaVinci\TaxiBundle\Entity\Payment\PaymentMethod;

use DaVinci\TaxiBundle\Event\FinancialOfficeEvents;
use DaVinci\TaxiBundle\Event\TransferOperationEvent;
use DaVinci\TaxiBundle\Services\Remote\RequesterException;

class InformationController extends StepsController 
{
	
	const ACTION_OFFICE_ADD = 'add';
	const ACTION_OFFICE_TRANSFER = 'transfer';

	public function viewOfficesAction()
	{
		return $this->render('DaVinciTaxiBundle:Information:view_offices.html.twig');
	}
	
	public function blogAction($column)
	{
        $comercialEntities = null;
        $entities = null;
        
		$dm = $this->get('doctrine_phpcr')->getManager();
		
		$columnRepository = $dm->getRepository('DaVinciTaxiBundle:BlogColumn');
		$columns = $columnRepository->findActive();
        $defaultColumn = $columnRepository->findDefault();
		
        $postEntityRepository = $dm->getRepository('DaVinciTaxiBundle:PostEntity');
        
        $column = ('default' == $column) 
            ? $defaultColumn
            : unserialize(urldecode($column));
        
    	$contentDocument = $postEntityRepository->find($column);
        if ($contentDocument) {
            $comercialEntities = $postEntityRepository->findFilteredForColumn($column, true);
            $entities = $postEntityRepository->findFilteredForColumn($column);  
        } 
		                
		return $this->render(
			'DaVinciTaxiBundle:Blog:detail.html.twig',
			array(
                'defaultColumn' => $columnRepository->findDefault(),
				'columns' => $columns,
                'commercialEntities' => $comercialEntities,
				'entities' => $entities				
			)
		);
	}
	
    public function profitAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        
        $driverTabs = $dm->getRepository('DaVinciTaxiBundle:ProfitPage')->getDriverProfitTab();
        $passengerTabs = $dm->getRepository('DaVinciTaxiBundle:ProfitPage')->getPassengerProfitTab();
        
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
        $allTabs = $dm->getRepository('DaVinciTaxiBundle:AboutPage')->findAll();
        
        return $this->render(
        	'DaVinciTaxiBundle:Information:about.html.twig',
			array('all_tabs' => $allTabs)
        );
    }

    public function helpAction()
    {
    	$dm = $this->get('doctrine_phpcr')->getManager();
    	
    	$guides = $dm
    				->getRepository('DaVinciTaxiBundle:GuidesPage')
    				->findPublished();
    	$faqs = $dm
			    	->getRepository('DaVinciTaxiBundle:FaqEntry')
			    	->findPublished();
    	
        return $this->render(
        	'DaVinciTaxiBundle:Information:help.html.twig',
        	array(
        		'guides' => $guides,
        		'faqs' => $faqs	
        	)	
        );
    }

    public function videoGuidesAction()
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $allVideos = $dm
        				->getRepository('DaVinciTaxiBundle:VideoGuidesPage')
        				->findBy(array('publishable' => true));
                    
        return $this->render(
        	'DaVinciTaxiBundle:Information:videos.html.twig',
			array('videos' => $allVideos)
        );
    }

    public function videoAction($contentDocument)
    {
         return $this->render(
         	'DaVinciTaxiBundle:Information:video.html.twig',
         	array('page' => $contentDocument)
         );
    }    

    public function guidesAction()
    {
    	$dm = $this->get('doctrine_phpcr')->getManager();
    	$allGuides = $dm
            ->getRepository('DaVinciTaxiBundle:GuidesPage')
            ->findBy(array('publishable' => true));
    
    	return $this->render(
    			'DaVinciTaxiBundle:Information:guides.html.twig',
    			array('guides' => $allGuides)
    	);
    }
    
    public function guideAction($contentId)
    {
    	$contentId = unserialize(urldecode($contentId));
    	$contentDocument = $this->get('doctrine_phpcr')
					    		->getManager()    	
					    		->getRepository('DaVinciTaxiBundle:GuidesPage')
					    		->find($contentId);
    	
        return $this->render(
        	'DaVinciTaxiBundle:Information:guide.html.twig',
			array('page' => $contentDocument)
        );
    }

    public function faqsAction($category)
    {
        $dm = $this->get('doctrine_phpcr')->getManager();
        $allFaqs = $dm->getRepository('DaVinciTaxiBundle:FaqEntry')->findBy(
        	array(
                'published' => true,
                'forPassenger' => ($category == 'passenger')
            )
        );
            
        return $this->render(
        	'DaVinciTaxiBundle:Information:faqs.html.twig',
			array(
                'faqs' => $allFaqs,
                'category' => $category
            )
        );
    }
    
    public function oneHelpAction()
    {
    	return $this->render('DaVinciTaxiBundle:Information:one_help.html.twig');
    }

    public function notificationsAction()
    {
        return $this->render('DaVinciTaxiBundle:Notifications:notifications.html.twig');
    }

    public function newTicketAction()
    {
        return $this->render('DaVinciTaxiBundle:Notifications:new_ticket.html.twig');
    }

    public function socialAction()
    {
		return $this->render(
        	'DaVinciTaxiBundle:Information:info.html.twig',
        	array(
                'reviews' => false,
        		'social' => true,
        		'isblog' => false
        	)
        );
    }
    
    /**
     * @Route("/reviews/{reviewColumn}", name="reviews", defaults={"reviewColumn" = "passengers"})
     */
    public function reviewsAction(Request $request, $reviewColumn)
    {
        $userCommentService = $this->get('da_vinci_taxi.service.user_comment');
        
        $form = $this->createForm('userComment');
        $form->handleRequest($request);
                
        $created = false;
        if ($form->isValid() && $request->isMethod('POST')) {
            $user = $this->get('security.context')->getToken()->getUser();
            if (is_null($user)) {
                return $this->redirect($this->generateUrl('fos_user_security_login'));
            }
            
            $comment = $form->getData();
            
            if (
                $this->get('security.context')->isGranted('ROLE_USER')
                && $comment->getColumn() == UserComment::FOR_PASSENGER
                || $this->get('security.context')->isGranted('ROLE_TAXIDRIVER')
                && $comment->getColumn() == UserComment::FOR_DRIVERS
                || $this->get('security.context')->isGranted('ROLE_TAXICOMPANY')
                && $comment->getColumn() == UserComment::FOR_COMPANIES
            ) {
                $userCommentService->create($comment, $user);
                $created = true;
            } else {
                $this->createAccessDeniedException("You don't have rights");
            }
        }
        
        return $this->render(
        	'DaVinciTaxiBundle:Information:info.html.twig',
            array(
            	'reviews' => true,
                'social' => false,
                'isblog' => false,
                'reviewColumn' => $reviewColumn,
                'reviewColumns' => UserComment::getTypeColumnList(),
                'form' => $form->createView(),
                'created' => $created,
                'items' => $userCommentService->getValidByColumn($reviewColumn)
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
    	
    	$eventName = (self::ACTION_OFFICE_ADD == $action)
	    	? FinancialOfficeEvents::OPERATION_ADD
	    	: FinancialOfficeEvents::OPERATION_INTERNAL_TRANSFER;
    	$filter = (self::ACTION_OFFICE_ADD == $action) 
    		? PaymentMethod::POS_INTERNAL_PAYMENT_METHOD
    		: 0;
    	    	
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		try {
    			$dispatcher = $this->container->get('event_dispatcher');
	    		$dispatcher->dispatch(
	    			$eventName,
	    			new TransferOperationEvent(
	    				$form->getData(),
	    				$this->getMakePaymentRepository(),
	    				MakePayments::DEFAULT_DESCRIPTION_SETTLE_ACCCOUNT	
	    			)
	    		);
	    		
	    		$result['operationCode'] = MakePayments::CODE_SUCCESS;
    		} catch (RequesterException $exception) {
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
    				'methods' => MakePaymentService::generateMethods($filter)    						
    			),
    			$result	
    		)	 
    	);
    }
        
}
