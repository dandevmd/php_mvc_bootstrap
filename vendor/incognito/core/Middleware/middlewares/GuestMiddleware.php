<?php

namespace dandevmd\mvccore\Middleware\middlewares;

use dandevmd\mvccore\Request;
use dandevmd\mvccore\Response;
use dandevmd\mvccore\Middleware\MiddlewareI;

class GuestMiddleware implements MiddlewareI
{
  public function handle(Request $request, Response $response)
  {
    if (isset($_SESSION['user'])) {
      $response->redirect('/');
    }
  }
}