<?php

namespace dandevmd\mvccore\Middleware;

use dandevmd\mvccore\Request;
use dandevmd\mvccore\Response;

interface MiddlewareI
{
  public function handle(Request $request, Response $response);
}