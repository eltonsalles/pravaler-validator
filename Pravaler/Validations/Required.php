<?php

namespace Pravaler\Component\Validator\Validations;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\NotBlank;

class Required extends AbstractHandler
{
    /**
     * Creates the validation rule
     *
     * @param string $rule
     * @return Constraint
     */
    public function handleConstraint(string $rule): Constraint
    {
        $this->nameHandle = 'required';

        if ($this->nameHandle === strtolower($rule)) {
            $required = new NotBlank([
                'message' => 'Campo obrigatório.'
            ]);

            $this->returnConstraint = $required;
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
