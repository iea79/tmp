<?php

namespace DaVinci\TaxiBundle\Services\Informer;

use DaVinci\TaxiBundle\Entity\User;
use DaVinci\TaxiBundle\Entity\MessageContent;
use DaVinci\TaxiBundle\Entity\MessageContentService;

use DaVinci\TaxiBundle\Utils\Assert;
use DaVinci\TaxiBundle\Event\PassengerRequestEvents;

abstract class AbstractInformer implements InformerInterface
{
	
	/**
	 * @var \DaVinci\TaxiBundle\Entity\MessageContentService
	 */
	protected $messageContentService;
	
	public function setMessageContentService(MessageContentService $messageContentService)
	{
		$this->messageContentService = $messageContentService;
	}
    
    public function notify(User $user, $literalCode, $recipient)
    {
        $contentInfo = $this->prepareContent($literalCode);
        if (!$contentInfo) {
            return;
        }
        
        $this->process($user, $contentInfo);
    }    

    /**
	 * @param string $literalCode
	 * @return \DaVinci\TaxiBundle\Entity\MessageContent
	 */
	protected function prepareContent($literalCode, $recipient)
	{
		Assert::inArray(
			PassengerRequestEvents::getEventList(), 
			$literalCode,
			get_class($this) . ": event literal code doesn't exist #{$literalCode}"	
		);
		
		return $this->messageContentService->getByLiteralCodeAndRecipient($literalCode, $recipient);
	}
    
    abstract protected function process(User $user, MessageContent $contentInfo);
	
}

?>