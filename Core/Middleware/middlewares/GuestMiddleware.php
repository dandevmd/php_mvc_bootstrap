<?php

namespace app\Core\Middleware\middlewares;

use app\Core\Request;
use app\Core\Response;
use app\Core\Middleware\MiddlewareI;

class GuestMiddleware implements MiddlewareI
{
  public function handle(Request $request, Response $response)
  {
    if (isset($_SESSION['user'])) {
      $response->redirect('/');
    }
  }
}