<?php

namespace DaVinci\TaxiBundle\Services\Informer;

use DaVinci\TaxiBundle\Entity\InternalMessageService;
use DaVinci\TaxiBundle\Entity\User;

class InternalInformer extends AbstractInformer implements InformerInterface 
{
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\InternalMessageService $messageService
	 */
	protected $internalMessageService;
	
	public function setInternalMessageService(\DaVinci\TaxiBundle\Entity\InternalMessageService $messageService)
	{
		$this->internalMessageService = $messageService;
	}
	
	public function notify(\DaVinci\TaxiBundle\Entity\User $user, $literalCode)
	{
		$message = $this->internalMessageService->spawnInstance();
		$message
			->setContent($this->prepareContent($literalCode))
			->setUser($user)
			->setCreateDate(new \DateTime());
		
		$this->internalMessageService->save($message);
	}
		
}

?>