<?php

namespace DaVinci\TaxiBundle\Services\Informer;

use DaVinci\TaxiBundle\Entity\InternalMessageService;
use DaVinci\TaxiBundle\Entity\User;
use DaVinci\TaxiBundle\Entity\MessageContent;

class InternalInformer extends AbstractInformer
{
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\InternalMessageService $messageService
	 */
	protected $internalMessageService;
	
	public function setInternalMessageService(InternalMessageService $messageService)
	{
		$this->internalMessageService = $messageService;
	}
	
	protected function process(User $user, MessageContent $contentInfo, $recipient)
	{
		if (!$contentInfo->isInternalNotification()) {
			return;
		}
				
		$message = $this->internalMessageService->spawnInstance();
		$message
            ->setSubject($contentInfo->getSubject())
			->setContent($contentInfo->getContent())
            ->setLiteralCode($contentInfo->getLiteralCode())
            ->setOffice($recipient)
            ->setUser($user)
			->setCreateDate(new \DateTime('now'));
		
		$this->internalMessageService->save($message);
	}
		
}

?>