<?php

namespace DaVinci\TaxiBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;

use DaVinci\TaxiBundle\Services\Remote\RemoteRequester;
use DaVinci\TaxiBundle\Services\Informer\InformerInterface;

use DaVinci\TaxiBundle\Event\FinancialOfficeEvents;
use DaVinci\TaxiBundle\Event\TransferOperationEvent;
use DaVinci\TaxiBundle\Entity\User;
use DaVinci\TaxiBundle\Entity\Payment\MakePayment;
use DaVinci\TaxiBundle\Entity\Payment\PaymentMethod;

class OfficeSubscriber implements EventSubscriberInterface 
{
	
	/**
	 * @var \DaVinci\TaxiBundle\Services\Remote\RemoteRequester
	 */
	private $remoteRequester;
	
	/**
	 * @var \DaVinci\TaxiBundle\Services\Informer\InformerInterface
	 */
	private $informer;
	
	public function __construct(RemoteRequester $requester, InformerInterface $informer)
	{
		$this->remoteRequester = $requester;
		$this->informer = $informer;
	}
	
	public static function getSubscribedEvents()
	{
		return array(
			FinancialOfficeEvents::TRANSFER_OPERATION => array('onTransferOperation', 0)
		);
	}
	
	public function onTransferOperation(TransferOperationEvent $event)
	{
		$makePayment = $event->getMakePayment();
		$user = $event->getSecurityContext()
					->getToken()
					->getUser();
		
		$paymentMethod = $makePayment->getPaymentMethod();
		$paymentMethod->addMakePayment($makePayment);
		 
		$makePayment->setPaymentMethod($paymentMethod);
		$makePayment->setDefaultTotalPrice();
		$makePayment->setUser($user);
		$makePayment->setDescription($event->getDescription());

		$this->saleOperation($makePayment, $this->getOpCodeForDirectPayment($makePayment));
		
		$event->getMakePaymentRepository()->save($makePayment);
	}
	
	private function saleOperation(MakePayment $makePayment, $opCode)
	{
		$this->remoteRequester->saleOpertation($makePayment, $opCode);
	}
	
	private function getOpCodeForDirectPayment(MakePayment $makePayment)
	{
		$type = $makePayment->getPaymentMethod()->getType();
			
		switch ($type) {
			case PaymentMethod::INTERNAL_PAYMENT_METHOD:
				$opCode = RemoteRequester::OPCODE_INTERNAL_TRANSFER_USER_TO_MERCHANT;
				break;
			
			case PaymentMethod::CREDIT_CARD_METHOD:
				$opCode = RemoteRequester::OPCODE_PAY_PAL_DIRECT_PAYMENT;
				break;
				
			case PaymentMethod::PAYPAL_METHOD:
				$opCode = RemoteRequester::OPCODE_PAY_PAL_DIRECT_PAYMENT;
				break;
				
			case PaymentMethod::SKRILL_METHOD:
				$opCode = RemoteRequester::OPCODE_SKRILL_DIRECT_PAYMENT;
				break;
							
			default:
				throw new \InvalidArgumentException(get_class($this) . ": unsupported payment method type #{$type}");	
		}
		
		return $opCode; 
	}
	
}

?>