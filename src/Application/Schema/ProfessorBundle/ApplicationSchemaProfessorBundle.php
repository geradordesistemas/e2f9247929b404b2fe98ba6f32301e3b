<?php

namespace App\Application\Schema\ProfessorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationSchemaProfessorBundle extends Bundle
{
    /** {@inheritdoc} */
    public function getParent()
    {
        return 'ApplicationSchemaProfessorBundle';
    }
}