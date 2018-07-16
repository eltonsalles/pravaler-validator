<?php

namespace Pravaler\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PasswordConfirm extends Constraint
{
    public $message = 'A senhas não são iguais';
}
