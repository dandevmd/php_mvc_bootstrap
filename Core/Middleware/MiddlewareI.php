<?php

namespace app\Core\Middleware;

use app\Core\Request;
use app\Core\Response;

interface MiddlewareI
{
  public function handle(Request $request, Response $response);
}