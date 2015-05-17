<?php

namespace DaVinci\TaxiBundle\Entity\Payment;

class MakePaymentService 
{
	
	const SERVICE_NAMESPACE = "DaVinci\TaxiBundle\Entity\Payment\\";
	const SERVICE_NAMESPACE_TYPE = "DaVinci\TaxiBundle\Form\Payment\Type\\";

	protected static $methods;
	
	/**
	 * @return \DaVinci\TaxiBundle\Form\Payment\MakePayment
	 */
	public function create(array $params = null)
	{
		return new MakePayment();
	}
	
	public function createConfigured(\Symfony\Component\HttpFoundation\Request $request)
	{
		$makePayment = $this->create();
		
		$methodCode = $this->getMethodCodeFromRequest($request);
		if ($methodCode) {
			$this->spawnPaymentMethod($makePayment, $methodCode);
			return $makePayment;
		}
		
		return $makePayment;
	}
	
	public static function createPaymentMethodFormType(\Symfony\Component\HttpFoundation\Request $request)
	{
		$methodCode = self::getMethodCodeFromRequest($request);
		if ($methodCode) {
			$className = self::getPaymentMethodClassName($methodCode);
			return new $className();
		}
	}
	
	static public function generateMethods()
	{
		foreach (PaymentMethod::getTypes() as $key => $value) {
			$paymentMethod = self::createOnlyPaymentMethod($value);
			$subTypes = $paymentMethod::getSubTypes();
			
			if (count($subTypes) > 0) {
				foreach ($subTypes as $subKey => $subValue) {
					self::$methods[$key . '_' . $subKey] = $subValue;
				} 
			} else {
				self::$methods[$key] = $value;
			}
		}
		
		return self::$methods;
	}
	
	static public function getMethodByCode($code)
	{
		if (!count(self::$methods)) {
			self::generateMethods();
		}
		
		if (!array_key_exists($code, self::$methods)) {
			throw new \InvalidArgumentException("Unsupported payment method code: {$code}");
		}
		
		return self::$methods[$code];
	}
	
	/**
	 * @param \DaVinci\TaxiBundle\Form\Payment\MakePayment $makePayment
	 * @param string $paymentMethodCode
	 * 
	 * @return \DaVinci\TaxiBundle\Form\Payment\MakePayment
	 */
	private function spawnPaymentMethod(
		\DaVinci\TaxiBundle\Form\Payment\MakePayment $makePayment, $paymentMethodCode
	) {
		if ($paymentMethodCode) {
			$methodData = explode('_', $paymentMethodCode);
	
			$methodCode = $methodData[0];
	
			$subType = null;
			if (isset($methodData[1])) {
				$subType = $methodData[1];
			}
	
			$makePayment->setPaymentMethod(
				$this->createPaymentMethod($methodCode, $subType)
			);
		}
	
		return $makePayment;
	}
	
	/**
	 * @param string $method
	 * @param string $type
	 * @return PaymentMethod
	 */
	private function createPaymentMethod($methodCode, $subType = null)
	{
		$method = PaymentMethod::getTypeByCode($methodCode);
		
		$object = self::createOnlyPaymentMethod($method);
		if (!is_null($subType)) {
			$object->setSubType($subType);
		}
		
		return $object;
	}
	
	static private function getMethodCodeFromRequest(\Symfony\Component\HttpFoundation\Request $request)
	{
		$methodCode = $request->get('methodCode');
		if ($methodCode) {
			return $methodCode;
		}
		
		$params = $request->get('makePaymentStepMethod');
		if (isset($params['paymentMethodCode'])) {
			return $params['paymentMethodCode'];
		}
		
		$params = $request->get('makePaymentStepPaymentInfo');
		if (isset($params['paymentMethodCode'])) {
			return $params['paymentMethodCode'];
		}
	}
	
	static private function createOnlyPaymentMethod($method) {
		$className = self::SERVICE_NAMESPACE . $method . PaymentMethod::CLASS_END;
		if (!class_exists($className)) {
			throw new \InvalidArgumentException("Unsupported payment method: {$method}");
		}
		
		return new $className();
	}
	
	static private function getPaymentMethodClassName($paymentMethodCode)
	{
		$methodData = explode('_', $paymentMethodCode);
	
		return (
			self::SERVICE_NAMESPACE_TYPE
				. PaymentMethod::getTypeByCode($methodData[0])
				. MakePayments::PAYMENT_INFO_TYPE
		);
	}
			
}

?>