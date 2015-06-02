<?php

namespace DaVinci\TaxiBundle\Services\Informer;

use DaVinci\TaxiBundle\Entity\MessageContentService;
use DaVinci\TaxiBundle\Utils\Assert;
use DaVinci\TaxiBundle\Event\PassengerRequestEvents;

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
	
	/**
	 * @param unknown $literalCode
	 * @return Ambigous <\DaVinci\TaxiBundle\Entity\MessageContent, NULL>
	 */
	protected function prepareContent($literalCode)
	{
		Assert::inArray(
			PassengerRequestEvents::getEventList(), 
			$literalCode,
			get_class($this) . ": event literal code doesn't exist #{$literalCode}"	
		);
		
		return $this->messageContentService->getByCode($literalCode);
	}
	
}

?>