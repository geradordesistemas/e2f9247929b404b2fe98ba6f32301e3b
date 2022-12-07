<?php

namespace App\Application\Schema\ProvaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationSchemaProvaBundle extends Bundle
{
    /** {@inheritdoc} */
    public function getParent()
    {
        return 'ApplicationSchemaProvaBundle';
    }
}