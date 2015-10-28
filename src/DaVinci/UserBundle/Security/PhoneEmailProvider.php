<?php
namespace DaVinci\UserBundle\Security;

use FOS\UserBundle\Security\UserProvider;

class PhoneEmailProvider extends UserProvider
{
    protected function findUser($username)
    {
        return $this->userManager->findUserByPhoneOrEmail($username);
    }
}