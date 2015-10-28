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
		$contentInfo = $this->prepareContent($literalCode);
		if (!$contentInfo->isInternalNotification()) {
			return;
		}
				
		$message = $this->internalMessageService->spawnInstance();
		$message
			->setContent($contentInfo->getContent())
			->setUser($user)
			->setCreateDate(new \DateTime());
		
		$this->internalMessageService->save($message);
	}
		
}

?>