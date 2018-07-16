<?php

namespace Pravaler\Component\Validator\Validations;

use Symfony\Component\Validator\Constraint;

class Cpf extends AbstractHandler
{
    /**
     * Creates the validation rule
     *
     * @param string $rule
     * @return Constraint
     */
    public function handleConstraint(string $rule): Constraint
    {
        $this->nameHandle = 'cpf';

        if ($this->nameHandle === strtolower($rule)) {
            $cpf = new \Pravaler\Component\Validator\Constraints\Cpf();

            $this->returnConstraint = $cpf;
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