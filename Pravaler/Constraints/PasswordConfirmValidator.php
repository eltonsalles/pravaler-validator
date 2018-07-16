<?php

namespace Pravaler\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PasswordConfirmValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $password = $this->context->getRoot()['password'];
        if ($password !== $value) {
            $this->context
                ->buildViolation('A senha e a confirmação da senha não são iguais')
                ->addViolation();
        }
    }
}
