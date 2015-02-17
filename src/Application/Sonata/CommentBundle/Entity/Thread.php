<?php

namespace Application\Sonata\CommentBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Sonata\CommentBundle\Entity\BaseThread as BaseThread;


class Thread extends BaseThread
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
}