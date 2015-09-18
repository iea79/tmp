<?php

namespace DaVinci\TaxiBundle\Event;

use DaVinci\TaxiBundle\Utils\Assert;

final class SystemEvents 
{
	
	static public function getDescriptionEventList()
    {
        return array_merge(
            PassengerRequestEvents::getDescriptionEventList()
        );
    }
    
    static public function getEventByLiteralCode($literalCode)
    {
        $list = self::getDescriptionEventList();
        Assert::indexIsSet(
            $list, $literalCode, "Undefined event code #{$literalCode}"
        );
            
        return $list[$literalCode];    
    }
		
}

?>