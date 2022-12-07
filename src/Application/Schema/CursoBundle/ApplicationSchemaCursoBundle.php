<?php

namespace App\Application\Schema\CursoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationSchemaCursoBundle extends Bundle
{
    /** {@inheritdoc} */
    public function getParent()
    {
        return 'ApplicationSchemaCursoBundle';
    }
}