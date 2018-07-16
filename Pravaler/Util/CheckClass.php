<?php

namespace Pravaler\Component\Validator\Util;

use Pravaler\Component\Validator\Exception\CheckClassException;

class CheckClass
{
    /**
     * @var string $namespace
     */
    private $namespace;

    /**
     * @var string $nameClass
     */
    private $nameClass;

    /**
     * Receives the namespace and name of a rule and checks if there is a class for it
     *
     * @param string $namespace
     * @param string $nameClass
     */
    public function __construct(string $namespace, string $nameClass)
    {
        $this->namespace = $namespace;
        $this->nameClass = $nameClass;
    }

    /**
     * Returns the class name
     *
     * @return string
     * @throws CheckClassException
     */
    public function getNameClass(): string
    {
        if (preg_match('/:/', $this->nameClass)) {
            $array = explode(':', $this->nameClass);
            if (preg_match('/_/', $array[0])) {
                $nameClass = str_replace('_', '', ucwords($array[0], '_'));
            } else {
                $nameClass = ucfirst($array[0]);
            }
        } elseif (preg_match('/_/', $this->nameClass)) {
            $nameClass = str_replace('_', '', ucwords($this->nameClass, '_'));
        } else {
            $nameClass = ucfirst($this->nameClass);
        }

        $class = $this->getClass($nameClass);

        if (!class_exists($class)) {
            throw new CheckClassException('Class not found: ' . $class);
        }

        return $class;
    }

    /**
     * @param string $nameClass
     * @return string
     */
    private function getClass(string $nameClass): string
    {
        return $this->namespace . $nameClass;
    }
}
