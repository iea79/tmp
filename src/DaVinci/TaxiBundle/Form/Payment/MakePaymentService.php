<?php

namespace DaVinci\TaxiBundle\Form\Payment;

class MakePaymentService 
{
	
	const SERVICE_NAMESPACE = "DaVinci\TaxiBundle\Form\Payment\\";
	const SERVICE_NAMESPACE_TYPE = "DaVinci\TaxiBundle\Form\Payment\Type\\";
	
	static protected $otherMethods = array(
		PaymentMethod::POS_PAYPAL_METHOD => PaymentMethod::PAYPAL_METHOD, 
		PaymentMethod::POS_SKRILL_METHOD => PaymentMethod::SKRILL_METHOD
	);
	
	/**
	 * @param array $params
	 * @return \DaVinci\TaxiBundle\Form\Payment\MakePayment
	 */
	public function create(array $params = null)
	{
		$makePayment = new MakePayment();
		
		if (is_null($params)) {
			return $makePayment;
		}
		
		if (isset($params['creditCardMethods'])) {
			$makePayment->setPaymentMethod($this->createPaymentMethod(
				PaymentMethod::CREDIT_CARD_METHOD, $params['creditCardMethods']
			));
		}
		
		if (isset($params['otherMethods'])) {
			$makePayment->setPaymentMethod($this->createPaymentMethod(
				self::getMethodByCode($params['otherMethods'])
			));
		}
		
		return $makePayment;
	}
	
	static public function getMethodByCode($code)
	{
		if (!array_key_exists($code, self::$otherMethods)) {
			throw new \InvalidArgumentException("Unsupported other payment method code: {$code}");
		}
		
		return self::$otherMethods[$code];
	}
	
	/**
	 * @param string $method
	 * @param string $type
	 * @return PaymentMethod
	 */
	private function createPaymentMethod($method, $type = null)
	{
		$className = self::SERVICE_NAMESPACE . $method . PaymentMethod::CLASS_END;
		if (!class_exists($className)) {
			throw new \InvalidArgumentException("Unsupported payment method: {$method}");
		}
		
		$object = new $className();
		if (!is_null($type)) {
			$object->setMethodType($type);
		}
		
		return $object;
	}
	
}

?>