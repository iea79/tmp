<?php

namespace DaVinci\TaxiBundle\Services\Remote;

use Lsw\ApiCallerBundle\Caller\LoggingApiCaller;
use Lsw\ApiCallerBundle\Call\HttpPostJson;

use Symfony\Component\Config\Definition\Exception\InvalidTypeException;
use Symfony\Component\HttpKernel\Exception\HttpException;

use DaVinci\TaxiBundle\Services\Remote\RequesterException;

use DaVinci\TaxiBundle\Entity\PassengerRequest;
use DaVinci\TaxiBundle\Entity\User;
use DaVinci\TaxiBundle\Entity\Tariff;
use DaVinci\TaxiBundle\Entity\Payment\MakePayment;
use DaVinci\TaxiBundle\Entity\Payment\MakePayments;
use DaVinci\TaxiBundle\Entity\Payment\CreditCardPaymentMethod;
use DaVinci\TaxiBundle\Services\Remote\HttpRequest;

class RemoteRequester
{
  
    const OPCODE_PAY_PAL_DIRECT_PAYMENT = 1;
    const OPCODE_SKRILL_DIRECT_PAYMENT = 2;
        
	const OPCODE_CREATE_USER_ACCOUNT = 3;
	const OPCODE_INTERNAL_TRANSFER_BETWEEN_USERS = 4;
	const OPCODE_INTERNAL_TRANSFER_USER_TO_MERCHANT = 5;
	const OPCODE_INTERNAL_TRANSFER_MERCHANT_TO_USER = 6;
	const OPCODE_SETTLE_ACCOUNT_PAY_PAL = 7;
	const OPCODE_SETTLE_ACCOUNT_SKRILL = 8;
	const OPCODE_INTERNAL_TRANSFER_ESCROW = 13;
	
	const OPERATION_FINISHED_SUCCESSFULLY = 0;
	        
    const GATEWAY_HOST = 'http://paygnet.taximyprice.com';
    const GATEWAY_PRODUCT_ID = 3;
    
    const PAYMENT_URI = '/gateway/payment';
    const OPERATION_URI = '/gateway/operation';
    const COMPLEX_URI = '/gateway/complex';
        
    /**
     * @var \Lsw\ApiCallerBundle\Caller\LoggingApiCaller
     */
    private $apiCaller;
    
    /**
     * @var \DaVinci\TaxiBundle\Services\Remote\HttpRequest
     */
    private $httpRequester;
    
    private $remoteEnable = true;
    private $useApiCaller = false;

    public function __construct(LoggingApiCaller $apiCaller, HttpRequest $httpRequester)
    {
        $this->apiCaller = $apiCaller;
        $this->httpRequester = $httpRequester;
    }
    
    public function makeOpertation(MakePayment $makePayment, $opCode) 
    {
    	$this->proxyProcess($makePayment, $opCode);
    }
    
    public function makePassengerRequestOperation(PassengerRequest $request, $opCode, $receiver = null)
    {
    	$this->proxyProcess($request, $opCode, $receiver);
    }
    
    public function makeUserOperation(User $user, $opCode)
    {
    	$this->proxyProcess($user, $opCode);
    }
    
    private function proxyProcess($requestData, $opCode, $receiver = null) 
    {
    	if (!$this->remoteEnable) {
    		return;
    	}
    	
    	if (!$this->checkOpCode($opCode)) {
    		throw new InvalidTypeException(
                get_class($this) . ": unsupported operation code #{$opCode}"
            );
    	}
    	
    	if ($this->useApiCaller) {
    		$this->process($requestData, $opCode, $receiver);
    		return;
    	}
    	
    	$this->httpProcess($requestData, $opCode, $receiver);
    }
    
    private function process($requestData, $opCode, $receiver = null)
    {
    	$call = new HttpPostJson(
    		$this->getOperationURL($opCode), 
    		$this->prepareRequest($requestData, $opCode, $receiver)
    	);
    	
    	$this->apiCaller->call($call);
    	$statusCode = $call->getStatusCode();
    	if ($statusCode != 200) {
    		throw new RequesterException(
    			get_class($this) . ": status code is #{$statusCode}"
			);
    	}
    	 
    	$responseData = $call->getResponseObject();
    	if (self::OPERATION_FINISHED_SUCCESSFULLY != $responseData->response->code) {
    		throw new RequesterException(
    			get_class($this) . ": response code is #{$responseData->response->code}"
    		);
    	}
    }
    
    private function httpProcess($requestData, $opCode, $receiver = null)
    {
    	$this->httpRequester->setOptions(array(
    		CURLOPT_HEADER => 1,
    		CURLOPT_VERBOSE => 1
    	));
    	$this->httpRequester->setMethod(HttpRequest::METHOD_POST);
    	$this->httpRequester->setJsonRequest(
    		$this->prepareRequest($requestData, $opCode, $receiver)
    	);
    	
    	$response = $this->httpRequester->execute($this->getOperationURL($opCode));
    	if ($response->hasError()) {
    		throw new RequesterException($response->getError());
    	}
    	
    	$body = $response->getDecodedBody();
    	if (self::OPERATION_FINISHED_SUCCESSFULLY != $body->response->code) {
    		throw new RequesterException(
    			get_class($this) . ": response code is #{$body->response->code}"
    		);
    	}
    }
    
    private function checkOpCode($opCode)
    {
    	return in_array($opCode, array(
    		self::OPCODE_PAY_PAL_DIRECT_PAYMENT,
    		self::OPCODE_SKRILL_DIRECT_PAYMENT,
    		self::OPCODE_CREATE_USER_ACCOUNT,
    		self::OPCODE_INTERNAL_TRANSFER_BETWEEN_USERS,
    		self::OPCODE_INTERNAL_TRANSFER_USER_TO_MERCHANT,
    		self::OPCODE_INTERNAL_TRANSFER_MERCHANT_TO_USER,
    		self::OPCODE_SETTLE_ACCOUNT_PAY_PAL,
    		self::OPCODE_SETTLE_ACCOUNT_SKRILL,
    		self::OPCODE_INTERNAL_TRANSFER_ESCROW							
    	));
    }
    
    private function prepareRequest($requestData, $opCode, $receiver = null)
    {
    	$params = array();
    	
    	$className = get_class($requestData);
        $requestName = substr($className, strrpos($className, '\\') + 1);
        
    	$methodName = 'getParamsFrom' . $requestName;
    	if (!method_exists($this, $methodName)) {
    		throw new InvalidTypeException(
                get_class($this) . ": unsupported method name #{$methodName}"
            );
    	}
        
        if ($requestName == 'MakePayment' || $requestName == 'PassengerRequest') {
            return array_merge(
                $this->$methodName($requestData, $opCode, $receiver),
                array('Opcode' => $opCode)
            );
        }
    	    	    	
    	if ($requestName == 'User') {
            return array_merge(
                $this->$methodName($requestData, $opCode),
                array('Opcode' => $opCode)
            );
        }
    }
    
    /**
     * @param MakePayment $makePayment
     * @param intenger $opCode
     * 
     * @return array
     */
    private function getParamsFromMakePayment(MakePayment $makePayment, $opCode, $receiver = null)
    {
    	switch ($opCode) {
    		case self::OPCODE_PAY_PAL_DIRECT_PAYMENT: {
    			$paymentMethod = $makePayment->getPaymentMethod();
    			
    			$params = array(
    				'Customer' => array(
    					'cardNumber' => $paymentMethod->getCardNumber(),
    					'cardType' => mb_strtolower(CreditCardPaymentMethod::CARD_TYPE_VISA),
    					'expirationMonth' => $paymentMethod->getExpirationMonth(),
    					'expirationYear' => intval('20' . $paymentMethod->getExpirationYear()),
    					'cvv' => $paymentMethod->getSecretSalt(),
    					'firstName' => $paymentMethod->getFirstname(),
    					'lastName' => $paymentMethod->getLastname(),
    					'address' => $paymentMethod->getAddress(),
    					'city' => 'Saratoga',
    					'state' => 'CA',
    					'zipCode' => $paymentMethod->getZipCode(),
    					'country' => 'US',
                        'externalUserId' => $makePayment->getUser()->getRemoteId()
    				),
    				'Transaction' => array(
    					'amount' => $makePayment->getTotalPrice()->getAmount(),
    					'currency' => $makePayment->getTotalPrice()->getCurrency(),
    					'custom1' => '0.00',
    					'custom2' => '0.00',
    					'custom3' => '0.00'
    				),
    				'Product' => self::GATEWAY_PRODUCT_ID
    			);
    			break;
    		}
    		
    		case self::OPCODE_SKRILL_DIRECT_PAYMENT: {
    			$paymentMethod = $makePayment->getPaymentMethod();
    		
    			$params = array(
    				'Customer' => array(
    					'email' => $paymentMethod->getEmail(),
    					'subject' => $paymentMethod->getSubject(),
    					'note' => $paymentMethod->getNote(),
                        'externalUserId' => $makePayment->getUser()->getRemoteId()
    				),
    				'Transaction' => array(
    					'amount' => $makePayment->getTotalPrice()->getAmount(),
    					'currency' => $makePayment->getTotalPrice()->getCurrency()
    				),
    				'Product' => self::GATEWAY_PRODUCT_ID
    			);
    			break;
    		}
    		
    		case self::OPCODE_INTERNAL_TRANSFER_BETWEEN_USERS: {
    			$params = array(
    				'User' => $makePayment->getUser()->getRemoteId(),
					'DepositTo' => array(
						'depositNumber' => $makePayment->getPaymentMethod()->getAccountId(),
					),	
					'Transaction' => array(
						'amount' => $makePayment->getTotalPrice()->getAmount(),
						'currency' => $makePayment->getTotalPrice()->getCurrency()
					)
    			);
    			break;
    		}
    		
    		case self::OPCODE_INTERNAL_TRANSFER_USER_TO_MERCHANT: {
    			$params = array(
    				'User' => $makePayment->getUser()->getRemoteId(),
    				'Transaction' => array(
    					'amount' => $makePayment->getTotalPrice()->getAmount(),
    					'currency' => $makePayment->getTotalPrice()->getCurrency()
    				),
    				'Product' => self::GATEWAY_PRODUCT_ID
    			);
    			break;
    		}
    		
    		case self::OPCODE_SETTLE_ACCOUNT_PAY_PAL: {
    			$paymentMethod = $makePayment->getPaymentMethod();
    			
    			$params = array(
    				'Customer' => array(
    					'cardNumber' => $paymentMethod->getCardNumber(),
    					'cardType' => mb_strtolower(CreditCardPaymentMethod::CARD_TYPE_VISA),
    					'expirationMonth' => $paymentMethod->getExpirationMonth(),
    					'expirationYear' => intval('20' . $paymentMethod->getExpirationYear()),
    					'cvv' => $paymentMethod->getSecretSalt(),
    					'firstName' => $paymentMethod->getFirstname(),
    					'lastName' => $paymentMethod->getLastname(),
    					'address' => $paymentMethod->getAddress(),
    					'city' => 'Saratoga',
    					'state' => 'CA',
    					'zipCode' => $paymentMethod->getZipCode(),
    					'country' => 'US',
    					'externalUserId' => $makePayment->getUser()->getId()
    				),
    				'Transaction' => array(
    					'amount' => $makePayment->getTotalPrice()->getAmount(),
    					'currency' => $makePayment->getTotalPrice()->getCurrency(),
    					'custom1' => '0.00',
    					'custom2' => '0.00',
    					'custom3' => '0.00'
    				),
    				'User' => $makePayment->getUser()->getRemoteId()
    			);
    			break;
    		}
    		
    		case self::OPCODE_SETTLE_ACCOUNT_SKRILL: {
    			$paymentMethod = $makePayment->getPaymentMethod();
    			 
    			$params = array(
    				'Customer' => array(
    					'email' => $paymentMethod->getEmail(),
    					'subject' => $paymentMethod->getSubject(),
    					'note' => $paymentMethod->getNote(),
    					'externalUserId' => $makePayment->getUser()->getId()
    				),
    				'Transaction' => array(
    					'amount' => $makePayment->getTotalPrice()->getAmount(),
    					'currency' => $makePayment->getTotalPrice()->getCurrency()
    				),
    				'User' => $makePayment->getUser()->getRemoteId()
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
    
    private function getParamsFromPassengerRequest(
        PassengerRequest $request, $opCode, $receiver = null
    ) {
        switch ($opCode) {
    		case self::OPCODE_INTERNAL_TRANSFER_MERCHANT_TO_USER: {
                if (is_null($receiver)) {
                    throw new \InvalidArgumentException(
                        get_class($this) . ": undefined receiver of transaction"
                    );
                }
                
    			$params = array(
    				'User' => $receiver->getRemoteId(),
    				'Product' => self::GATEWAY_PRODUCT_ID,	
    				'Transaction' => array(
    					'amount' => $request->getTariff()->getPrice(),
    					'currency' => MakePayments::DEFAULT_CURRENCY
    				),
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
    
    private function getParamsFromUser(User $user, $opCode)
    {
        switch ($opCode) {
    		case self::OPCODE_CREATE_USER_ACCOUNT: {
    			$params = array(
    				'User' => array(
    					'email' => $user->getEmail(),
    					'externalId' => $user->getId()
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
    		case self::OPCODE_INTERNAL_TRANSFER_MERCHANT_TO_USER:
    		case self::OPCODE_INTERNAL_TRANSFER_ESCROW: {
    			$uri = self::OPERATION_URI;
    			break;
    		}
    		
    		case self::OPCODE_SETTLE_ACCOUNT_PAY_PAL:
    		case self::OPCODE_SETTLE_ACCOUNT_SKRILL: {
    			$uri = self::COMPLEX_URI;
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