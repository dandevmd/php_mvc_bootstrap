<?php

namespace app\Core\Attributes;

use app\Core\Enum\HttpMethod;

interface IRoute
{

  public function __construct(string $path, string $method, ?array $middleware = []);

}