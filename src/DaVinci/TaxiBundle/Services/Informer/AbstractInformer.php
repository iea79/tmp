<?php

namespace DaVinci\TaxiBundle\Services\Informer;

use DaVinci\TaxiBundle\Entity\MessageContentService;

abstract class AbstractInformer 
{
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\MessageContentService
	 */
	protected $messageContentService;
	
	public function setMessageContentService(MessageContentService $messageContentService)
	{
		$this->messageContentService = $messageContentService;
	}
	
	protected function prepareContent($literalCode)
	{
		return $this->messageContentService
				->getByCode($literalCode)
				->getContent();
	}
	
}

?>