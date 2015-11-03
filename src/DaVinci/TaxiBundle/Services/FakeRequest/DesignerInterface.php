<?php

namespace DaVinci\TaxiBundle\Services\FakeRequest;

use DaVinci\TaxiBundle\Entity\PassengerRequest;

interface DesignerInterface 
{
	
	public function modify(PassengerRequest $request);
	
}

?>