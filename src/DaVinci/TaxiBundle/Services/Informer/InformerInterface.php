<?php

namespace DaVinci\TaxiBundle\Services\Informer;

use DaVinci\TaxiBundle\Entity\User;

interface InformerInterface 
{
	
	/**
	 * @param \DaVinci\TaxiBundle\Entity\User $user
	 * @param string $literalCode
     * @param string $recipient
	 */
	public function notify(User $user, $literalCode, $recipient);
	
}

?>