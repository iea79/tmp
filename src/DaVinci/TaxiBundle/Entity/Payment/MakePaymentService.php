<?php

namespace DaVinci\TaxiBundle\Entity\Payment;

use Symfony\Component\HttpFoundation\Request;

class MakePaymentService 
{
	
	const SERVICE_NAMESPACE = "DaVinci\TaxiBundle\Entity\Payment\\";
	const SERVICE_NAMESPACE_TYPE = "DaVinci\TaxiBundle\Form\Payment\Type\\";

	protected static $methods;
    
    /**
     * @var DaVinci\TaxiBundle\Entity\Payment\MakePaymentRepository
     */
    protected $repository;
    
    public function __construct(MakePaymentRepository $repository) 
    {
        $this->repository = $repository;
    }
    
    /**
     * @return DaVinci\TaxiBundle\Entity\Payment\MakePaymentRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }    

    /**
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePayment
	 */
	public function create(array $params = null)
	{
		return new MakePayment();
	}
	
	public function createConfigured(Request $request)
	{
		$makePayment = $this->create();
		
		$methodCode = $this->getMethodCodeFromRequest($request);
		if ($methodCode) {
			$this->spawnPaymentMethod($makePayment, $methodCode);
			return $makePayment;
		}
		
		return $makePayment;
	}
	
	public static function createPaymentMethodFormType(Request $request)
	{
		$methodCode = self::getMethodCodeFromRequest($request);
		if ($methodCode) {
			$className = self::getPaymentMethodClassName($methodCode);
			return new $className();
		}
	}
	
	static public function generateMethods($filter = 0)
	{
		$types = PaymentMethod::getTypes();
		if (array_key_exists($filter, $types)) {
			unset($types[$filter]);
		}
		
		foreach ($types as $key => $value) {
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
	 * @param \DaVinci\TaxiBundle\Entity\Payment\MakePayment $makePayment
	 * @param string $paymentMethodCode
	 * 
	 * @return \DaVinci\TaxiBundle\Entity\Payment\MakePayment
	 */
	private function spawnPaymentMethod(
		\DaVinci\TaxiBundle\Entity\Payment\MakePayment $makePayment, $paymentMethodCode
	) {
		if ($paymentMethodCode) {
			$methodData = explode('_', $paymentMethodCode);
	
			$methodCode = $methodData[0];
	
			$subType = null;
			if (isset($methodData[1])) {
				$subType = $methodData[1];
			}
	
			$makePayment->setPaymentMethodCode($paymentMethodCode);
			$makePayment->setPaymentMethod(
				$this->createPaymentMethod($methodCode, $subType)
			);
		}
	
		return $makePayment;
	}
	
	/**
	 * @param string $method
	 * @param string $type
	 * @return \DaVinci\TaxiBundle\Entity\Payment\PaymentMethod
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
	
	static private function getMethodCodeFromRequest(Request $request)
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