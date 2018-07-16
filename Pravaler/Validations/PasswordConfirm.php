<?php

namespace Pravaler\Component\Validator\Validations;

use Symfony\Component\Validator\Constraint;

class PasswordConfirm extends AbstractHandler
{
    /**
     * Creates the validation rule
     *
     * @param string $rule
     * @return Constraint
     */
    public function handleConstraint(string $rule): Constraint
    {
        $this->nameHandle = 'password_confirm';

        if ($this->nameHandle === strtolower($rule)) {
            $passwordConfirm = new \Pravaler\Component\Validator\Constraints\PasswordConfirm();

            $this->returnConstraint = $passwordConfirm;
        } elseif ($this->nextHandle !== null) {
            $this->returnConstraint = $this->nextHandle->handleConstraint($rule);
        }

        return $this->returnConstraint;
    }

    /**
     * Arrow next rule of validation
     *
     * @param AbstractHandler $handler
     */
    public function setNextHandle(AbstractHandler $handler): void
    {
        $this->nextHandle = $handler;
    }
}
