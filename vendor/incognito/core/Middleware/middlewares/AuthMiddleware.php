<?php

namespace dandevmd\mvccore\Middleware\middlewares;

use dandevmd\mvccore\Request;
use dandevmd\mvccore\Middleware\MiddlewareI;
use dandevmd\mvccore\Response;

class AuthMiddleware implements MiddlewareI
{
  public function handle(Request $request, Response $response)
  {
    if (!isset($_SESSION['user'])) {
      $response->redirect('/login');
    }

  }
}