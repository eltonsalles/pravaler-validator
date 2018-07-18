<?php

namespace Pravaler\Component\Validator\Validations;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Regex as RegexConstrain;

class Regex extends AbstractHandler
{
    /**
     * Creates the validation rule
     *
     * @param string $rule
     * @return Constraint
     */
    public function handleConstraint(string $rule): Constraint
    {
        $this->nameHandle = 'regex';

        $params = explode(':', $rule);

        if ($this->nameHandle === strtolower($params[0])) {
            $regex = new RegexConstrain([
                'pattern' => $params[1],
                'message' => 'Valor inválido.'
            ]);

            $this->returnConstraint = $regex;
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
