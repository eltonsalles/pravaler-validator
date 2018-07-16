<?php

namespace Pravaler\Component\Validator\Validations;

use Symfony\Component\Validator\Constraint;

class Email extends AbstractHandler
{
    /**
     * Creates the validation rule
     *
     * @param string $rule
     * @return Constraint
     */
    public function handleConstraint(string $rule): Constraint
    {
        $this->nameHandle = 'email';

        if ($this->nameHandle === strtolower($rule)) {
            $email = new \Symfony\Component\Validator\Constraints\Email([
                'message' => 'Este valor não é um endereço de email válido.'
            ]);

            $this->returnConstraint = $email;
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
