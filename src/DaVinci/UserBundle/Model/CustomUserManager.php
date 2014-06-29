<?php

namespace DaVinci\UserBundle\Model;

use FOS\UserBundle\Doctrine\UserManager as BaseUserManager;

class CustomUserManager extends BaseUserManager
{

    
    /**
     * Finds a user either by email, or phone
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

        return $this->findUserBy(array('phone' => $phoneOrEmail));
    }

}
