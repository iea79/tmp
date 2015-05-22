<?php

namespace DaVinci\TaxiBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use DaVinci\TaxiBundle\Services\RemoteRequester;

use DaVinci\TaxiBundle\Event\FinancialOfficeEvents;
use DaVinci\TaxiBundle\Event\TransferOperationEvent;
use DaVinci\TaxiBundle\Entity\User;
use DaVinci\TaxiBundle\Entity\Payment\MakePayment;
use DaVinci\TaxiBundle\Entity\Payment\PaymentMethod;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OfficeSubscriber implements EventSubscriberInterface 
{
	
	/**
	 * @var \DaVinci\TaxiBundle\Services\RemoteRequester
	 */
	private $remoteRequester;
	
	public function __construct(RemoteRequester $requester)
	{
		$this->remoteRequester = $requester;
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

		$this->transferOperation($makePayment, $this->getOpCode($makePayment));
		
		$event->getMakePaymentRepository()->save($makePayment);
	}
	
	private function transferOperation(MakePayment $makePayment, $opCode)
	{
		$this->remoteRequester->transferOpertation($makePayment, $opCode);
	}
	
	private function getOpCode(MakePayment $makePayment)
	{
		$type = $makePayment->getPaymentMethod()->getType();
			
		switch ($type) {
			case PaymentMethod::INTERNAL_PAYMENT_METHOD:
				$opCode = RemoteRequester::OPCODE_INTERNAL_TRANSFER_BETWEEN_USERS;
				break;
			
			case PaymentMethod::CREDIT_CARD_METHOD:
				throw new \InvalidArgumentException(get_class($this) . ": unsupported payment method type #{$type}");
				
			case PaymentMethod::PAYPAL_METHOD:
				$opCode = RemoteRequester::OPCODE_SETTLE_ACCOUNT_PAY_PAL;
				break;
				
			case PaymentMethod::SKRILL_METHOD:
				$opCode = RemoteRequester::OPCODE_SETTLE_ACCOUNT_SKRILL;
				break;
							
			default:
				throw new \InvalidArgumentException(get_class($this) . ": unsupported payment method type #{$type}");	
		}
		
		return $opCode; 
	}
	
}

?>