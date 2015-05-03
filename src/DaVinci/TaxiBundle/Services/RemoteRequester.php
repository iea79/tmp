<?php

namespace DaVinci\TaxiBundle\Services;

use Lsw\ApiCallerBundle\Caller\LoggingApiCaller;
use Lsw\ApiCallerBundle\Call\HttpPostJson;

use Symfony\Component\Config\Definition\Exception\InvalidTypeException;
use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\User;

class RemoteRequester
{
  
    const OPCODE_PAY_PAL_DIRECT_PAYMENT = 1;
    const OPCODE_SKRILL_DIRECT_PAYMENT = 2;
        
	const OPCODE_CREATE_USER_ACCOUNT = 3;
	const OPCODE_INTERNAL_TRANSFER_BETWEEN_USERS = 4;
	const OPCODE_INTERNAL_TRANSFER_USER_TO_MERCHANT = 5;
	const OPCODE_INTERNAL_TRANSFER_MERCHANT_TO_USER = 6;
	const OPCODE_INTERNAL_TRANSFER_ESCROW = 13;
	        
    const GATEWAY_HOST = 'http://payment.mmastarter.com';
    
    const PAYMENT_URI = '/gateway/payment';
    const OPERATION_URI = '/gateway/operation';
    
    const GATEWAY_PRODUCT_ID = 2;
    const GATEWAY_DEFAULT_CURRENCY = "USD";

    /**
     * @var Lsw\ApiCallerBundle\Caller\LoggingApiCaller
     */
    private $apiCaller;
    
    private $remoteEnable = false;

    public function __construct(LoggingApiCaller $apiCaller)
    {
        $this->apiCaller = $apiCaller;
    }
    
    public function makeOperation(PassengerRequest $request, $opCode)
    {
    	return $this->proxyProcess($request, $opCode);
    }
    
    public function makeUserOperation(User $user, $opCode)
    {
    	return $this->proxyProcess($user, $opCode);
    }
    
    private function proxyProcess($requestData, $opCode) 
    {
    	if (!$this->remoteEnable) {
    		return true;
    	}
    	
    	return $this->process($requestData, $opCode);
    }
    
    private function process($requestData, $opCode)
    {
    	if (!$this->checkOpCode($opCode)) {
    		throw InvalidTypeException(get_class($this) . ": unsupported operation code #{$opCode}");
    	}
 
    	$this->apiCaller->call(new HttpPostJson(
    		$this->getOperationURL($opCode), 
    		$this->prepareRequest($requestData, $opCode)
    	));
    	 
    	if ($this->apiCaller->getStatusCode() != 200) {
    		return false;
    	}
    	 
    	$response = $this->apiCaller->getResponseObject();
    	return ($response->code == 0);
    }
    
    private function checkOpCode($opCode)
    {
    	return in_array($opCode, array(
    		self::OPCODE_PAY_PAL_DIRECT_PAYMENT,
    		self::OPCODE_SKRILL_DIRECT_PAYMENT,
    		self::OPCODE_CREATE_USER_ACCOUNT,
    		self::OPCODE_INTERNAL_TRANSFER_BETWEEN_USERS,
    		self::OPCODE_INTERNAL_TRANSFER_USER_TO_MERCHANT,
    		self::OPCODE_INTERNAL_TRANSFER_MERCHANT_TO_USER				
    	));
    }
    
    private function prepareRequest($requestData, $opCode)
    {
    	$params = array();
    	if ($requestData instanceof \DaVinci\TaxiBundle\Entity\PassengerRequest) {
    		$params = $this->getOperationParams($requestData, $opCode);
    	}
    	
    	if ($requestData instanceof \DaVinci\TaxiBundle\Entity\PassengerRequest) {
    		$params = $this->getUserOperationParams($requestData, $opCode);
    	}
    	    	
    	return array_merge(array('Opcode' => $opCode), $params);
    }
    
    private function getOperationParams(PassengerRequest $request, $opCode)
    {
    	switch ($opCode) {
    		case self::OPCODE_CREATE_USER_ACCOUNT: {
    			$params = array(
    				'User' => array(
						"email" => $request->getUser()->getEmail(),
						"externalId" => $request->getUser()->getId()
					)
    			);
    			break;
    		}
    		
    		case self::OPCODE_INTERNAL_TRANSFER_MERCHANT_TO_USER: {
    			$params = array(
    				"User" => $request->getUser()->getRemoteId(),
    				"Product" => self::GATEWAY_PRODUCT_ID,	
    				"Transaction" => array(
    					"amount" => $request->getTariff()->getTotalPrice(),
    					"currency" => self::GATEWAY_DEFAULT_CURRENCY
    				),
    			);
    		}
    		
    		default: {
    			$params = array();
    			break;
    		}
    	}
    	
    	return $params;
    }
    
    private function getUserOperationParams(User $user, $opCode)
    {
    	switch ($opCode) {
    		case self::OPCODE_CREATE_USER_ACCOUNT: {
    			$params = array(
    				'User' => array(
    					"email" => $user->getEmail(),
    					"externalId" => $user->getId()
    				)
    			);
    			break;
    		}
    		        
    		default: {
    			$params = array();
    			break;
    		}
    	}
    	 
    	return $params;
    }
    
    /**
     * @param int $opCode
     * @return string
     */
    private function getOperationUrl($opCode)
    {
    	switch ($opCode) {
    		case self::OPCODE_PAY_PAL_DIRECT_PAYMENT:
    		case self::OPCODE_SKRILL_DIRECT_PAYMENT: {
    			$uri = self::PAYMENT_URI;
    			break;
    		}
    
    		case self::OPCODE_CREATE_USER_ACCOUNT:
    		case self::OPCODE_INTERNAL_TRANSFER_BETWEEN_USERS:
    		case self::OPCODE_INTERNAL_TRANSFER_USER_TO_MERCHANT:
    		case self::OPCODE_INTERNAL_TRANSFER_USER_TO_MERCHANT:
    		case self::OPCODE_INTERNAL_TRANSFER_ESCROW: {
    			$uri = self::OPERATION_URI;
    			break;
    		}
    
    		default: {
    			$uri = self::PAYMENT_URI;
    			break;
    		}
    	}
    
    	return self::GATEWAY_HOST . $uri;
    }
    
}

?>