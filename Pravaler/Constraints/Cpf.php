<?php

namespace Pravaler\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Cpf extends Constraint
{
    public $message = "O CPF '{{ string }}' é inválido";
}
