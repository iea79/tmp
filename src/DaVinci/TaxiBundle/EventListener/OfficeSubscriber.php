<?php

namespace DaVinci\TaxiBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpKernel\Exception\HttpException;

use DaVinci\TaxiBundle\Services\Remote\RemoteRequester;
use DaVinci\TaxiBundle\Services\Informer\InformerInterface;

use DaVinci\TaxiBundle\Event\FinancialOfficeEvents;
use DaVinci\TaxiBundle\Event\TransferOperationEvent;
use DaVinci\TaxiBundle\Entity\User;
use DaVinci\TaxiBundle\Entity\Payment\MakePayment;
use DaVinci\TaxiBundle\Entity\Payment\PaymentMethod;
use DaVinci\TaxiBundle\Entity\Payment\MakePayments;
use DaVinci\TaxiBundle\Entity\Money;
use DaVinci\TaxiBundle\Utils\Assert;

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
	
	/**
	 * @var \Symfony\Component\Security\Core\SecurityContext
	 */
	private $securityContext;
	
	public function __construct(
		RemoteRequester $requester, 
		InformerInterface $informer,
		SecurityContext $securityContext
	) {
		$this->remoteRequester = $requester;
		$this->informer = $informer;
		$this->securityContext = $securityContext;
	}
	
	public static function getSubscribedEvents()
	{
		return array(
			FinancialOfficeEvents::OPERATION_SALE => array('onSaleOperation', 0),
			FinancialOfficeEvents::OPERATION_ADD => array('onAddOperation', 0),
			FinancialOfficeEvents::OPERATION_INTERNAL_TRANSFER => array('onInternalTransferOperation', 0)
		);
	}
	
	public function onAddOperation(TransferOperationEvent $event)
	{
		$makePayment = $this->prepareMakePayment($event);
		
		$this->methodAvailable($makePayment, FinancialOfficeEvents::OPERATION_ADD);
		$this->process(
			$makePayment, 
			$this->getOpCode($makePayment, FinancialOfficeEvents::OPERATION_ADD)
		);
	
		$event->getMakePaymentRepository()->save($makePayment);
	}
	
	public function onSaleOperation(TransferOperationEvent $event)
	{
		$makePayment = $this->prepareMakePayment($event);
		
		$this->methodAvailable($makePayment, FinancialOfficeEvents::OPERATION_SALE);
		$this->process(
			$makePayment, 
			$this->getOpCode($makePayment, FinancialOfficeEvents::OPERATION_SALE)
		);
	
		$event->getMakePaymentRepository()->save($makePayment);
	}
	
	public function onInternalTransferOperation(TransferOperationEvent $event)
	{
		$makePayment = $this->prepareMakePayment($event);
	
		$this->methodAvailable($makePayment, FinancialOfficeEvents::OPERATION_INTERNAL_TRANSFER);
		$this->process(
			$makePayment, 
			$this->getOpCode($makePayment, FinancialOfficeEvents::OPERATION_INTERNAL_TRANSFER)
		);
	
		$event->getMakePaymentRepository()->save($makePayment);
	}
	
	/**
	 * @param TransferOperationEvent $event
	 * 
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePayment
	 */
	private function prepareMakePayment(TransferOperationEvent $event) {
		$makePayment = $event->getMakePayment();
		$user = $this->securityContext
					->getToken()
					->getUser();
		
		$paymentMethod = $makePayment->getPaymentMethod();
		$paymentMethod->addMakePayment($makePayment);
					
		$makePayment->setPaymentMethod($paymentMethod);
		$makePayment->setUser($user);
		$makePayment->setDescription($event->getDescription());
		if ($makePayment->getAmount() > 0) {
			$money = new Money();
			$money->setCurrency(MakePayments::DEFAULT_CURRENCY);
			$money->setAmount($makePayment->getAmount());
			
			$makePayment->setTotalPrice($money);
		} else {
			$makePayment->setDefaultTotalPrice();
		}		
		
		return $makePayment;
	}
	
	private function process(MakePayment $makePayment, $opCode)
	{
		$this->remoteRequester->makeOpertation($makePayment, $opCode);
	}
	
	private function getOpCode(MakePayment $makePayment, $methodName)
	{
		$type = $makePayment->getPaymentMethod()->getType();
			
		switch ($type) {
			case PaymentMethod::INTERNAL_PAYMENT_METHOD: {
				$opCode = (FinancialOfficeEvents::OPERATION_SALE == $methodName) 
					? RemoteRequester::OPCODE_INTERNAL_TRANSFER_USER_TO_MERCHANT
					: RemoteRequester::OPCODE_INTERNAL_TRANSFER_BETWEEN_USERS;
				break;
			}
			
			case PaymentMethod::CREDIT_CARD_METHOD:
			case PaymentMethod::PAYPAL_METHOD: {
				$opCode = (FinancialOfficeEvents::OPERATION_SALE == $methodName)
					? RemoteRequester::OPCODE_PAY_PAL_DIRECT_PAYMENT
					: RemoteRequester::OPCODE_SETTLE_ACCOUNT_PAY_PAL;
				break;
			}
							
			case PaymentMethod::SKRILL_METHOD: {
				$opCode = (FinancialOfficeEvents::OPERATION_SALE == $methodName)
					? RemoteRequester::OPCODE_SKRILL_DIRECT_PAYMENT
					: RemoteRequester::OPCODE_SETTLE_ACCOUNT_SKRILL;
				break;
			}
							
			default:
				throw new \InvalidArgumentException(get_class($this) . ": unsupported payment method type #{$type}");	
		}
		
		return $opCode; 
	}
	
	private function methodAvailable(MakePayment $makePayment, $methodName)
	{
		$type = $makePayment->getPaymentMethod()->getType();

		if (FinancialOfficeEvents::OPERATION_SALE == $methodName) {
			Assert::inArray(
				array(
					PaymentMethod::INTERNAL_PAYMENT_METHOD, 
					PaymentMethod::CREDIT_CARD_METHOD,
					PaymentMethod::PAYPAL_METHOD,
					PaymentMethod::SKRILL_METHOD
				),
				$type,
				get_class($this) . ": unsupported #{$methodName} :: payment method type #{$type}"
			);
		}
		
		if (FinancialOfficeEvents::OPERATION_ADD == $methodName) {
			Assert::inArray(
				array(
					PaymentMethod::CREDIT_CARD_METHOD,
					PaymentMethod::PAYPAL_METHOD,
					PaymentMethod::SKRILL_METHOD
				),
				$type,
				get_class($this) . ": unsupported #{$methodName} :: payment method type #{$type}"
			);
		}
		
		if (FinancialOfficeEvents::OPERATION_INTERNAL_TRANSFER == $methodName) {
			Assert::inArray(
				array(
					PaymentMethod::INTERNAL_PAYMENT_METHOD
				),
				$type,
				get_class($this) . ": unsupported #{$methodName} :: payment method type #{$type}"
			);
		}
	}
	
}

?>