<?php

namespace Phpbr\Bundle\AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PhpbrAppBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
