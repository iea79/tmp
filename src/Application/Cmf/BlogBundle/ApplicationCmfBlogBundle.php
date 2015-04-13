<?php

namespace Application\Cmf\BlogBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationCmfBlogBundle extends Bundle
{
    public function getParent()
    {
        return 'CmfBlogBundle';
    }
}