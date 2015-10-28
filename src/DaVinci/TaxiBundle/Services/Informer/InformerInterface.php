<?php

namespace DaVinci\TaxiBundle\Services\Informer;

interface InformerInterface 
{
	
	/**
	 * @param \DaVinci\TaxiBundle\Entity\User $user
	 * @param string $literalCode
	 */
	public function notify(\DaVinci\TaxiBundle\Entity\User $user, $literalCode);
	
}

?>