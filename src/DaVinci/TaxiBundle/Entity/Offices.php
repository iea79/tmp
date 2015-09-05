<?php

namespace DaVinci\TaxiBundle\Entity;

final class Offices
{
	const RECIPIENT_USER = 'user';
    const RECIPIENT_TAXI_INDEPENDENT_DRIVER = 'taxi-independent-driver';
    const RECIPIENT_TAXI_COMPANY_DRIVER = 'taxi-company-driver';
    
	static public function getDescriptionList()
    {
        return array(
			self::RECIPIENT_USER => 'User',
			self::RECIPIENT_TAXI_INDEPENDENT_DRIVER => 'Independent taxi dirver',
			self::RECIPIENT_TAXI_COMPANY_DRIVER => "Taxi company's driver"		
		);
    }    
		
}