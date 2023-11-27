<?php

namespace app\Core\Middleware;

use app\Core\Request;
use app\Core\Response;
use app\Core\Middleware\middlewares\AuthMiddleware;
use app\Core\Middleware\middlewares\GuestMiddleware;


class MapMiddleware
{


  protected const MAP = [
    'auth' => AuthMiddleware::class,
    'guest' => GuestMiddleware::class
  ];

  public static function resolve(string $key, Request $request, Response $response)
  {
    if (!array_key_exists($key, self::MAP)) {
      throw new \Exception("The {$key} middleware is not defined");
    }
    $middleware = self::MAP[$key] ?? null;

    return (new $middleware())->handle($request, $response);
  }


}