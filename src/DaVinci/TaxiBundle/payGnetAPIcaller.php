<?php

namespace DaVinci\TaxiBundle;

use Lsw\ApiCallerBundle\Caller\LoggingApiCaller;
use Lsw\ApiCallerBundle\Call\HttpPostJson;

class payGnetAPIcaller
{
    private $apiCaller;
    
    const baseURL = 'http://payment.mmastarter.com';
    
    //operations
    const MAKE_PAYMENT = 1;
    
    const REGISTER_USER = 3;
    const TRANSFER_FUNDS = 4;
    const DEPOSITE_FUNDS = 5;

    //return operation url baseurl+opuri
    private function getOperationURL($opCode)
    {
        switch ($opCode) {
            case self::MAKE_PAYMENT:
                $uri = '/gateway/payment';
            case self::REGISTER_USER:
            case self::TRANSFER_FUNDS:
            case self::DEPOSITE_FUNDS:
                $uri = '/gateway/operation';
            default:
                $uri = '/gateway/payment';
        }
        return self::baseURL . $uri;
    }
    
    //make payment
    const paymentURI = '/gateway/payment';

    //register new user=email
    const registerURI = '/gateway/operation';
    
    public function __construct(LoggingApiCaller $apiCaller)
    {
        $this->apiCaller = $apiCaller;
    }

    public function registerUser($email, $externalID)
    {
        $parameters = array(
			'User' => array(
				"email" => $email,
				"externalId" => $externalID 
			),
			'Opcode' => self::REGISTER_USER
		);
        $response = $this->apiCaller->call(new HttpPostJson($this->getOperationURL(self::REGISTER_USER), $parameters));
        
        //ok?
        if($response->getStatusCode() == 200)
        {
            //echo $response->getBody();  
        }
        /*
// Add custom error handling to any request created by this client
$client->getEventDispatcher()->addListener(
    'request.error', 
    function(Event $event) {

        //write log here ...

        if ($event['response']->getStatusCode() == 401) {

            // create new token and resend your request...
            $newRequest = $event['request']->clone();
            $newRequest->setHeader('X-Auth-Header', MyApplication::getNewAuthToken());
            $newResponse = $newRequest->send();

            // Set the response object of the request without firing more events
            $event['response'] = $newResponse;

            // You can also change the response and fire the normal chain of
            // events by calling $event['request']->setResponse($newResponse);

            // Stop other events from firing when you override 401 responses
            $event->stopPropagation();
        }

});
         *          */
    }
}