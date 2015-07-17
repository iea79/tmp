<?php

namespace DaVinci\TaxiBundle\Entity;

use DaVinci\TaxiBundle\Entity\User;

/**
 * UserCommentService
 */
class UserCommentService
{
    
    /**
	 * @var UserCommentRepository
	 */
	private $repository;
	
	public function setUserCommentRepository(UserCommentRepository $repository)
	{
		$this->repository = $repository;
	}
	
	public function create(UserComment $comment, User $user, $column)
	{
		$comment->setState(UserComment::STATUS_MODERATE);
        $comment->setTypeByColumn($column);
        $comment->setUser($user);
        
        $this->save($comment);
	}
    
    /**
     * @param string $column
     * @return array
     */
    public function getValidByColumn($column)
    {
        return $this->repository->findByColumnAndState(
            $column,
            UserComment::STATUS_VALID
        );
    }    

    /**
	 * @param UserComment $comment
	 * @return void
	 */
	public function save(UserComment $comment)
	{
		$this->repository->save($comment);
	}
			
}

?>
