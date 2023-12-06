<?php

namespace app\Core\Attributes;

use Attribute;
use app\Core\Enum\HttpMethod;

#[Attribute]
class Route
{
  public string $path;
  public HttpMethod $method;
  public ?string $middleware;

  public function __construct(string $path, HttpMethod $method, ?string $middleware = null)
  {
    $this->path = $path;
    $this->method = $method;
    $this->middleware = $middleware;
  }
}