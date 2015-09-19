<?php

namespace DaVinci\TaxiBundle\Event;

final class PassengerRequestEvents 
{
	
	const APPROVE_REQUEST = 'approve.request';
	const DECLINE_DRIVER_REQUEST = 'decline-driver.request';
	const CANCEL_REQUEST = 'cancel.request';
	
	static public function getEventList()
	{
		return array(
			self::APPROVE_REQUEST,
			self::DECLINE_DRIVER_REQUEST,
			self::CANCEL_REQUEST		
		);
	}
    
    static public function getDescriptionEventList()
    {
        return array(
			self::APPROVE_REQUEST => 'Approve request',
			self::DECLINE_DRIVER_REQUEST => 'Decline driver by user',
			self::CANCEL_REQUEST => 'Cancel request by user'		
		);
    }    
		
}