<?php

namespace DaVinci\TaxiBundle\Form\Payment;

class MakePaymentService 
{
	
	const SERVICE_NAMESPACE = "DaVinci\TaxiBundle\Form\Payment\\";
	const SERVICE_NAMESPACE_TYPE = "DaVinci\TaxiBundle\Form\Payment\Type\\";

	protected static $methods;
	
	/**
	 * @return \DaVinci\TaxiBundle\Form\Payment\MakePayment
	 */
	public function create(array $params = null)
	{
		return new MakePayment();
	}
	
	/**
	 * @param \DaVinci\TaxiBundle\Form\Payment\MakePayment $makePayment
	 * @param string $paymentMethodCode
	 * @return \DaVinci\TaxiBundle\Form\Payment\MakePayment
	 */
	public function spawnPaymentMethod(
		\DaVinci\TaxiBundle\Form\Payment\MakePayment $makePayment, $paymentMethodCode
	) {
		if ($paymentMethodCode) {
			$methodData = explode('_', $paymentMethodCode);
		
			$methodCode = $methodData[0];
				
			$type = null;
			if (isset($methodData[1])) {
				$type = $methodData[1];
			}
				
			$makePayment->setPaymentMethod(
				$this->createPaymentMethod($methodCode, $type)
			);
		}
		
		return $makePayment;
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
			throw new \InvalidArgumentException("Unsupported other payment method code: {$code}");
		}
		
		return self::$methods[$code];
	}
	
	/**
	 * @param string $method
	 * @param string $type
	 * @return PaymentMethod
	 */
	private function createPaymentMethod($methodCode, $type = null)
	{
		$method = PaymentMethod::getTypeByCode($methodCode);
		$object = self::createOnlyPaymentMethod($method);
		if (!is_null($type)) {
			$object->setSubType($type);
		}
		
		return $object;
	}
	
	static private function createOnlyPaymentMethod($method) {
		$className = self::SERVICE_NAMESPACE . $method . PaymentMethod::CLASS_END;
		if (!class_exists($className)) {
			throw new \InvalidArgumentException("Unsupported payment method: {$method}");
		}
		
		return new $className();
	}
	
}

?>