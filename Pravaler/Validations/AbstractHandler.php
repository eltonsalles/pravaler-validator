<?php

namespace Pravaler\Component\Validator\Validations;

use Symfony\Component\Validator\Constraint;

abstract class AbstractHandler
{
    /**
     * @var AbstractHandler $nextHandle
     */
    protected $nextHandle;

    /**
     * @var string $nameHandle
     */
    protected $nameHandle;

    /**
     * @var Constraint $returnConstraint
     */
    protected $returnConstraint;

    /**
     * Creates the validation rule
     *
     * @param string $rule
     * @return Constraint
     */
    abstract public function handleConstraint(string $rule): Constraint;

    /**
     * Arrow next rule of validation
     *
     * @param AbstractHandler $handler
     */
    abstract public function setNextHandle(AbstractHandler $handler): void;
}
