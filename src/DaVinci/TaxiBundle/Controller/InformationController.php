<?php

namespace DaVinci\TaxiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use DaVinci\TaxiBundle\Entity\UserComment;
use DaVinci\TaxiBundle\Entity\Payment\MakePayments;
use DaVinci\TaxiBundle\Entity\Payment\MakePaymentService;
use DaVinci\TaxiBundle\Entity\Payment\PaymentMethod;
use DaVinci\TaxiBundle\Entity\Offices;

use DaVinci\TaxiBundle\Event\FinancialOfficeEvents;
use DaVinci\TaxiBundle\Event\TransferOperationEvent;

use DaVinci\TaxiBundle\Services\Remote\RequesterException;
use DaVinci\TaxiBundle\Utils\Assert;

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
    	$dm = $this->get('doctrine_phpcr')->getManager();
		
		$columnRepository = $dm->getRepository('DaVinciTaxiBundle:BlogColumn');
		$postEntityRepository = $dm->getRepository('DaVinciTaxiBundle:PostEntity');
        
        $defaultColumn = $columnRepository->findDefault();
        $columnId = ('default' == $column) 
            ? $defaultColumn->getId()
            : unserialize(urldecode($column));
        $columns = $columnRepository->findActive();
        
        $count = 0;
        $others = array();
        foreach ($columns as $column) {
            if ($count > 2) {
                break;
            }
            
            if ($column->getId() != $columnId) {
                $others[$column->getTitle()] = $postEntityRepository->findFilteredForColumn(
                    $column->getId()
                );
                                
                $count++;
            }            
        }
        
		return $this->render(
			'DaVinciTaxiBundle:Blog:detail.html.twig',
			array(
                'defaultColumn' => $defaultColumn,
				'columns' => $columns,
                'columnId' => $columnId,
                'commercialEntities' => $postEntityRepository->findFilteredForColumn(
                    $columnId, true
                ),
				'entities' => $postEntityRepository->findFilteredForColumn($columnId),
                'others' => $others
			)
		);
	}
    
    public function postAction($post)
	{        
        $postId = unserialize(urldecode($post));
        
		$dm = $this->get('doctrine_phpcr')->getManager();
		
		$columnRepository = $dm->getRepository('DaVinciTaxiBundle:BlogColumn');
		$postEntityRepository = $dm->getRepository('DaVinciTaxiBundle:PostEntity');
        
        $actualPost = $postEntityRepository->find($postId);
        if (is_null($actualPost)) {
            throw new NotFoundHttpException('Undefined post requested');
        }
        
        $columnId = $actualPost->getBlogColumn()->getId();
        $columns = $columnRepository->findActive();
        
        $count = 0;
        $others = array();
        foreach ($columns as $column) {
            if ($count > 2) {
                break;
            }
            
            if ($column->getId() != $columnId) {
                $others[$column->getTitle()] = $postEntityRepository->findFilteredForColumn(
                    $column->getId()
                );
                                
                $count++;
            }            
        }
                		                
		return $this->render(
			'DaVinciTaxiBundle:Blog:detail.html.twig',
			array(
                'post' => $actualPost,
                'column' => $actualPost->getBlogColumn(),
                'columnId' => $columnId,
                'defaultColumn' => $columnRepository->findDefault(),
				'columns' => $columnRepository->findActive(),
                'commercialEntities' => $postEntityRepository->findFilteredForColumn(
                    $columnId, true
                ),
				'entities' => $postEntityRepository->findFilteredForColumn($columnId),
                'others' => $others
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

    public function helpAction($section)
    {
        $trigger = ('passenger' == $section);
        
    	$dm = $this->get('doctrine_phpcr')->getManager();
    	$guides = $dm
    				->getRepository('DaVinciTaxiBundle:GuidesPage')
    				->findForPassenger($trigger);
    	$faqs = $dm
			    	->getRepository('DaVinciTaxiBundle:FaqEntry')
			    	->findForPassenger($trigger);
    	
        return $this->render(
        	'DaVinciTaxiBundle:Information:help.html.twig',
        	array(
        		'guides' => $guides,
        		'faqs' => $faqs,
                'section' => $section
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

    public function guidesAction($category, $subCategory)
    {
    	$trigger = ($category == 'passenger');
        
        $dm = $this->get('doctrine_phpcr')->getManager();
        $faqs = $dm
                    ->getRepository('DaVinciTaxiBundle:FaqEntry')
                    ->findForPassenger($trigger);
        
        $category = unserialize(urldecode($subCategory));
        $guides = $dm
    				->getRepository('DaVinciTaxiBundle:GuidesPage')
    				->findFiltered($trigger, $category);
        $otherGuides = $dm
    				->getRepository('DaVinciTaxiBundle:GuidesPage')
    				->findFiltered(!$trigger, $category);
    
    	return $this->render(
            'DaVinciTaxiBundle:Information:guides.html.twig',
            array(
                'faqs' => $faqs,
                'guides' => $guides,
                'category' => $category,
                'otherGuides' => $otherGuides
            )
    	);
    }
    
    public function guideAction($contentId)
    {
    	$id = unserialize(urldecode($contentId));
    	$contentDocument = $this->get('doctrine_phpcr')->getManager()    	
					    		->getRepository('DaVinciTaxiBundle:GuidesPage')
					    		->find($id);
        if (is_null($contentDocument)) {
            throw new NotFoundHttpException("Undefined guide document identificator #{$id}");
        }
        
        return $this->render(
        	'DaVinciTaxiBundle:Information:guide.html.twig',
			array('page' => $contentDocument)
        );
    }

    public function faqsAction($category)
    {
        $trigger = ($category == 'passenger');
        
        $dm = $this->get('doctrine_phpcr')->getManager();
        $faqs = $dm
                    ->getRepository('DaVinciTaxiBundle:FaqEntry')
                    ->findForPassenger($trigger);
        $guides = $dm
    				->getRepository('DaVinciTaxiBundle:GuidesPage')
    				->findForPassenger($trigger);
            
        return $this->render(
        	'DaVinciTaxiBundle:Information:faqs.html.twig',
			array(
                'faqs' => $faqs,
                'guides' => $guides,
                'category' => $category
            )
        );
    }
    
    public function oneHelpAction()
    {
    	return $this->render('DaVinciTaxiBundle:Information:one_help.html.twig');
    }

    /**
     * @Route("/notifications/{section}", name="notifications", defaults={"section" = "all"})
     * @Security("has_role('ROLE_USER')")
     */
    public function notificationsAction($section)
    {
        $role = ($this->get('security.context')->isGranted('ROLE_TAXIDRIVER')) 
            ? 'ROLE_TAXIDRIVER'
            : 'ROLE_USER';
                
        $messages = $this->get('da_vinci_taxi.service.internal_message')
            ->getRepository()
            ->findBy(array(
                'user' => $this->get('security.context')->getToken()->getUser(),
                'office' => Offices::getOfficeByRole($role)
            ));
        
        return $this->render('DaVinciTaxiBundle:Notifications:notifications.html.twig', array(
            'messages' => $messages,
            'number' => count($messages)
        ));
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
     * @Route("/financial-office/history/{section}", name="financial_office_history", defaults={"section" = "payment"})
     * @Security("has_role('ROLE_USER')")
     */
    public function financialOfficeHistoryAction($section)
    {
        Assert::inArray(
            MakePayments::getOperationTypesList(), 
            $section, 
            "Undefined history section #{$section}"
        );
        
        $operations = $this
            ->get('da_vinci_taxi.service.make_payment_service')
            ->getRepository()
            ->findBy(array(
                'user' => $this->get('security.context')->getToken()->getUser(),
                'operationType' => $section
            ));
      
    	return $this->render(
    		'DaVinciTaxiBundle:Finoffice:financial_office.html.twig',
    		array(
    			'action' => 'history',
                'section' => $section,
                'operations' => $operations
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
        
        $methods = MakePaymentService::generateMethods($filter);
        
        Assert::indexIsSet(
            $methods, $methodCode, "Undefined method code #{$methodCode}"
        );
    	    	
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		try {
    			$dispatcher = $this->container->get('event_dispatcher');
	    		$dispatcher->dispatch(
	    			$eventName,
	    			new TransferOperationEvent(
	    				$form->getData(),
	    				$this->getMakePaymentRepository(),
	    				MakePayments::DEFAULT_DESCRIPTION_SETTLE_ACCCOUNT,
                        MakePayments::OPERATION_ADDITION
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
    				'methods' => $methods
    			),
    			$result	
    		)	 
    	);
    }
        
}
