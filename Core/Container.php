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
    if (!$this->has($key)) {
      throw new \Exception("No resolver for $key");
    }

    $resolver = $this->bindings[$key];

    return $resolver($this);
  }


  public function has(string $key): bool
  {
    return isset($this->bindings[$key]);
  }
}