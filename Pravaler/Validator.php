<?php

namespace Pravaler\Component\Validator;

use Pravaler\Component\Validator\Util\CheckClass;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Validation;

class Validator
{
    const PRAVALER_CONSTRAINTS = "Pravaler\\Component\\Validator\\Validations\\";

    private $validator;
    private $asserts;
    private $violations = [];

    /**
     * Receives an array with the names of the fields as key and the validation rules as value
     *
     * @param array $params
     */
    public function __construct(array $params)
    {
        $asserts = $this->getAsserts($params);
        $this->asserts = new Constraints\Collection($asserts);
        $this->asserts->allowExtraFields = true;
        $this->asserts->missingFieldsMessage = 'Este campo está faltando.';
        $this->validator = Validation::createValidator();
    }

    /**
     * Receives an array with form data
     *
     * @param $inputs
     */
    public function validate($inputs): void
    {
        $this->violations = $this->validator->validate((array)$inputs, $this->asserts);
    }

    /**
     * Check whether the fields respect the rules
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return (count($this->violations) <= 0);
    }

    /**
     * Returns an array with error messages
     *
     * @return array
     */
    public function getViolations(): array
    {
        $messages = [];
        foreach ($this->violations as $violation) {
            $param = preg_replace('/[^0-9a-zA-Z_\-\s]/', '', $violation->getPropertyPath());
            $messages[] = [$param => $violation->getMessage()];
        }

        return $messages;
    }

    /**
     * Returns an array with the validation rules for the fields
     *
     * @param $params
     * @return array
     */
    private function getAsserts($params): array
    {
        $assertsCollection = [];
        foreach ($params as $key => $value) {
            $rules = explode('|', $value);
            $handlers = [];
            foreach ($rules as $rule) {
                $class = (new CheckClass(self::PRAVALER_CONSTRAINTS, $rule))->getNameClass();
                $handlers[] = new $class();
            }
            for ($i = 0; $i < count($handlers) - 1; $i++) {
                $handlers[$i]->setNextHandle($handlers[$i + 1]);
            }
            foreach ($rules as $rule) {
                $assertsCollection[$key][] = $handlers[0]->handleConstraint($rule);
            }
        }

        return $assertsCollection;
    }
}
