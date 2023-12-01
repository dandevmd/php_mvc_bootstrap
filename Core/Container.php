<?php

namespace app\Core;

class Container
{
  protected $bindings = [];


  public function register(string $key, callable $resolver): void
  {
    $this->bindings[$key] = $resolver;
  }
  public function resolve(string $key)
  {
    if ($this->has($key)) {
      $resolver = $this->bindings[$key];

      return $resolver($this);
    }

    return $this->getClass($key);
  }

  public function getClass(string $key): callable|string|object
  {
    //Inspect the class that we are trying get from the container
    $reflectionClass = new \ReflectionClass($key);

    // check if is instantiable
    if (!$reflectionClass->isInstantiable()) {
      throw new \Exception('Class ' . $key . ' is not instantiable');
    }

    // check if has constructor and if has parameters
    if (!$reflectionClass->getConstructor() || !$reflectionClass->getConstructor()->getParameters()) {
      return new $key;
    }

    //if has constructor and has parameters which are class/classes then resolve them
    $dependencies = array_map(function (\ReflectionParameter $parameter) {
      $name = $parameter->getName();
      $type = $parameter->getType();

      if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {

        return $this->resolve($type->getName());
      }


    }, $reflectionClass->getConstructor()->getParameters());

    return $reflectionClass->newInstanceArgs($dependencies);
  }
  public function has(string $key): bool
  {
    return isset($this->bindings[$key]);
  }
}