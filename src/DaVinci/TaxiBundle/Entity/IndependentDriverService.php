<?php

namespace DaVinci\TaxiBundle\Entity;

use DaVinci\TaxiBundle\Entity\IndependentDriver;
use DaVinci\TaxiBundle\Entity\Address;
use DaVinci\TaxiBundle\Entity\Phone;

/**
 * IndependentDriverService
 */
class IndependentDriverService
{
    
    /**
     * @return IndependentDriver
     */
    public function spawnInstance()
    {
        return new IndependentDriver();
    }

    /**
     * @return IndependentDriver
     */
    public function generateDriver()
	{
		$driver = $this->spawnInstance();
        $driver->setAddress(new Address());
        $driver->addPhone(new Phone()); 
						
		return $driver;
	}
    				
}