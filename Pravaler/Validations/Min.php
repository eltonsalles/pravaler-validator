<?php

namespace Pravaler\Component\Validator\Validations;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\LessThan;

class Min extends AbstractHandler
{
    /**
     * Creates the validation rule
     *
     * @param string $rule
     * @return Constraint
     */
    public function handleConstraint(string $rule): Constraint
    {
        $this->nameHandle = 'min';

        $params = explode(':', $rule);

        if ($this->nameHandle === strtolower($params[0])) {
            $min = new LessThan([
                'value' => $params[1],
                'message' => 'O valor é menor do que o permitido: ' . $params[1]
            ]);

            $this->returnConstraint = $min;
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
