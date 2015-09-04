<?php

namespace DaVinci\TaxiBundle\Entity;

/**
 * MessageContentService
 */
class MessageContentService
{
	
	/**
	 * @var MessageContentRepository
	 */
	private $repository;
	
	public function setMessageContentRepository(MessageContentRepository $repository)
	{
		$this->repository = $repository;
	}
	
	public function spawnInstance()
	{
		return new MessageContent();
	}
	
	/**
	 * @param string $literalCode
     * @param string $recipient
	 * @return Ambigous <NULL, \DaVinci\TaxiBundle\Entity\MessageContent>
	 */
	public function getByLiteralCodeAndRecipient($literalCode)
	{
		return $this->repository->findByLiteralCodeAndRecipient($literalCode, $recipient);
	}
	
	/**
	 * @param MessageContent $message
	 * @return void
	 */
	public function save(MessageContent $messageContent)
	{
		$this->repository->save($messageContent);
	}
			
}

?>