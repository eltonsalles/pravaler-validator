<?php

namespace Pravaler\Component\Validator\Validations;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\GreaterThan;

class Max extends AbstractHandler
{
    /**
     * Creates the validation rule
     *
     * @param string $rule
     * @return Constraint
     */
    public function handleConstraint(string $rule): Constraint
    {
        $this->nameHandle = 'max';

        $params = explode(':', $rule);

        if ($this->nameHandle === strtolower($params[0])) {
            $max = new GreaterThan([
                'value' => $params[1],
                'message' => 'O valor é maior do que o permitido: ' . $params[1]
            ]);

            $this->returnConstraint = $max;
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
