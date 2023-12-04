<?php

namespace app\Core\Attributes;

use Attribute;
use app\Core\Enum\HttpMethod;
use app\Core\Attributes\Route;

#[Attribute]
class POST extends Route
{

  public function __construct(public string $path, public string $method = HttpMethod::POST->name, public ?array $middleware = [])
  {
    $this->method = HttpMethod::POST->name;
    parent::__construct($path, $this->method, $middleware);
  }
}