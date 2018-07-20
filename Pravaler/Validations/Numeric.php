<?php

namespace Pravaler\Component\Validator\Validations;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Type;

class Numeric extends AbstractHandler
{
    /**
     * Creates the validation rule
     *
     * @param string $rule
     * @return Constraint
     */
    public function handleConstraint(string $rule): Constraint
    {
        $this->nameHandle = 'numeric';

        if ($this->nameHandle === strtolower($rule)) {
            $numeric = new Type([
                'type' => 'numeric',
                'message' => 'O valor não é numérico.'
            ]);

            $this->returnConstraint = $numeric;
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
