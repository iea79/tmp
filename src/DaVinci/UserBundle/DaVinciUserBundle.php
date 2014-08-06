<?php

namespace DaVinci\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DaVinciUserBundle extends Bundle
{
    public function getParent()
    {
        return 'SonataUserBundle';
    }
}