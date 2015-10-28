<?php

namespace DaVinci\TaxiBundle\Entity;

/**
 * InternalMessageService
 */
class InternalMessageService
{
	
	/**
	 * @var InternalMessageRepository
	 */
	private $repository;
	
	public function setInternalMessageRepository(InternalMessageRepository $repository)
	{
		$this->repository = $repository;
	}
	
	public function spawnInstance()
	{
		return new InternalMessage();
	}
	
	/**
	 * @param InternalMessage $message
	 * @return void
	 */
	public function save(InternalMessage $message)
	{
		$this->repository->save($message);
	}
			
}

?>