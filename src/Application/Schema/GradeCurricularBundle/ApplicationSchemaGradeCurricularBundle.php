<?php

namespace App\Application\Schema\GradeCurricularBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationSchemaGradeCurricularBundle extends Bundle
{
    /** {@inheritdoc} */
    public function getParent()
    {
        return 'ApplicationSchemaGradeCurricularBundle';
    }
}