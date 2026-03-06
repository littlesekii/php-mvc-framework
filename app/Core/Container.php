<?php

namespace App\Core;

use ReflectionClass;
use Exception;

class Container
{
    public function make(string $class): object
    {
        if (!class_exists($class)) {
            throw new Exception("Class {$class} not found");
        }

        $reflection = new ReflectionClass($class);
        if (!$reflection->isInstantiable()) {
            throw new Exception("Class {$class} is not instantiable");
        }

        $constructor = $reflection->getConstructor();
        if (!$constructor) {
            return new $class;
        }

        $dependencies = [];
        foreach ($constructor->getParameters() as $param) {
            $paramType = $param->getType();

            if (!$paramType) {
                throw new Exception("Cannot resolve dependency \${$param->getName()} in {$class}");
            }

            $dependencies[] = $this->make($paramType->getName());
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}