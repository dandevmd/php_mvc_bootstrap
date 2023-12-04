<?php

namespace app\Core\Attributes;

use Attribute;
use app\Core\Enum\HttpMethod;
use app\Core\Attributes\IRoute;

#[Attribute]
class Route implements IRoute
{
  public function __construct(public string $path, public string $method, public ?array $middleware = [])
  {

  }
}