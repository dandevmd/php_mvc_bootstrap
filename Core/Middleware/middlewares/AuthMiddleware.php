<?php

namespace app\Core\Middleware\middlewares;

use app\Core\Request;
use app\Core\Middleware\MiddlewareI;
use app\Core\Response;

class AuthMiddleware implements MiddlewareI
{
  public function handle(Request $request, Response $response)
  {
    if (!isset($_SESSION['user'])) {
      $response->redirect('/login');
    }

  }
}