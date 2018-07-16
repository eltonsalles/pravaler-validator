<?php

namespace Pravaler\Component\Validator\Validations;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Length;

class Size extends AbstractHandler
{
    /**
     * Creates the validation rule
     *
     * @param string $rule
     * @return Constraint
     */
    public function handleConstraint(string $rule): Constraint
    {
        $this->nameHandle = 'size';

        $params = explode(':', $rule);

        if ($this->nameHandle === strtolower($params[0])) {
            $size = new Length([
                'min' => $params[1],
                'max' => $params[2],
                'minMessage' => 'O valor é menor do que o permitido: ' . $params[1],
                'maxMessage' => 'O valor é maior do que o permitido: ' . $params[2]
            ]);

            $this->returnConstraint = $size;
        } elseif ($this->nextHandle !== null) {
            $this->returnConstraint = $this->handleConstraint($rule);
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
