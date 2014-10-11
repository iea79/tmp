<?php

namespace DaVinci\UserBundle\Model;

use Sonata\UserBundle\Entity\UserManager as BaseUserManager;

class CustomUserManager extends BaseUserManager
{

    
    /**
     * Finds a user either by email, or phone or username
     *
     * @param string $phoneOrEmail
     *
     * @return UserInterface
     */
    public function findUserByPhoneOrEmail($phoneOrEmail)
    {
        if (filter_var($phoneOrEmail, FILTER_VALIDATE_EMAIL)) {
            return $this->findUserByEmail($phoneOrEmail);
        }
        $user = $this->findUserBy(array('phone' => $phoneOrEmail));
        if($user == NULL)
            $user = $this->findUserBy(array('username' => $phoneOrEmail));
        return $this->findUserBy(array('phone' => $phoneOrEmail));
    }

}
