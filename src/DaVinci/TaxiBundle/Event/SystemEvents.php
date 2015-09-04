<?php

namespace DaVinci\TaxiBundle\Event;

final class SystemEvents 
{
	
	static public function getDescriptionEventList()
    {
        return array_merge(
            PassengerRequestEvents::getDescriptionEventList()
        );
    }    
		
}

?>