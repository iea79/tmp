<?php

namespace DaVinci\TaxiBundle\Services\FakeRequest;

use DaVinci\TaxiBundle\Entity\PassengerRequest;

class CompositeDesigner implements DesignerInterface
{
	
	private $designers = array();
	
	public function add(DesignerInterface $designer)
	{
		$key = get_class($designer);
		$this->designers[$key] = $designer;
	}
	
	public function remove(DesignerInterface $designer)
	{
		$key = get_class($designer);
		unset($this->designers[$key]);
	}
	
	public function modify(PassengerRequest $request) 
	{
		foreach ($this->designers as $designer) {
			$designer->modify($request);
		}
	}
	
}

?>