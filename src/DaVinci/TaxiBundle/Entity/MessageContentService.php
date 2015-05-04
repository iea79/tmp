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
	 * @param unknown $literalCode
	 * @return Ambigous <NULL, \DaVinci\TaxiBundle\Entity\MessageContent>
	 */
	public function getByCode($literalCode)
	{
		return $this->repository->findByLiteralCode($literalCode);
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