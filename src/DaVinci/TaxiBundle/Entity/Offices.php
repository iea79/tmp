<?php

namespace DaVinci\TaxiBundle\Entity;

use DaVinci\TaxiBundle\Utils\Assert;

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
    
    static public function getOfficeByRole($role)
    {
        $offices = self::getOffices();
        Assert::indexIsSet(
            $offices, $role, "Undefined role name #{$role}"
        );
            
        return $offices[$role];    
    }
    
    static public function getOffices()
    {
        return array(
            'ROLE_USER' => self::RECIPIENT_USER,
            'ROLE_TAXIDRIVER' => self::RECIPIENT_TAXI_INDEPENDENT_DRIVER,
            'ROLE_COMPANYDRIVER' => self::RECIPIENT_TAXI_COMPANY_DRIVER
        );
    }    
		
}