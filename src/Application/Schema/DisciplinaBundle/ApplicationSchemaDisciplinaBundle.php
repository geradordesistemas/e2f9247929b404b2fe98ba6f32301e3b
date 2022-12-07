<?php

namespace App\Application\Schema\DisciplinaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationSchemaDisciplinaBundle extends Bundle
{
    /** {@inheritdoc} */
    public function getParent()
    {
        return 'ApplicationSchemaDisciplinaBundle';
    }
}