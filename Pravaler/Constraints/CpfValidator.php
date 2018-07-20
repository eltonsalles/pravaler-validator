<?php

namespace Pravaler\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CpfValidator extends ConstraintValidator
{
    /**
     * Verifica se o valor passado é válido.
     *
     * @param string $value O valor que deve ser validado
     * @param Constraint $constraint A restrição para a validação
     */
    public function validate($value, Constraint $constraint)
    {
        if (!empty($constraint->message)) {
            $message = $constraint->message;
        } else {
            $message = 'O CPF informado é inválido';
        }

        $cpf = preg_replace('/[^0-9]/is', '', $value);

        if (strlen($cpf) != 11) {
            $this->context->buildViolation($message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
            return;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $this->context->buildViolation($message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
            return;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                $this->context->buildViolation($message)
                    ->setParameter('{{ string }}', $value)
                    ->addViolation();
                return;
            }
        }
    }
}
