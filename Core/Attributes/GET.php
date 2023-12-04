<?php

namespace app\Core\Attributes;

use Attribute;
use app\Core\Enum\HttpMethod;
use app\Core\Attributes\Route;

#[Attribute]
class GET extends Route
{

  public function __construct(public string $path, public string $method = HttpMethod::GET->name, public ?array $middleware = [])
  {
    $this->method = HttpMethod::GET->name;
    parent::__construct($path, $this->method, $middleware);
  }
}