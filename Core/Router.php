<?php

namespace app\Core;

use app\Core\Middleware\MapMiddleware;


class Router
{

  private array $routes = [];
  public Request $request;
  public Response $response;

  public function __construct()
  {
    $this->request = Application::resolveContainer('app\Core\Request');
    $this->response = Application::resolveContainer('app\Core\Response');
  }

  public function get(string $path, string|callable|array $callback, array $middlewares = []): self
  {
    $this->routes['GET'][$path] = $callback;
    $this->routes['GET'][$path]['middlewares'] = $middlewares;

    return $this;
  }

  public function post(string $path, string|callable|array $callback, array $middlewares = []): self
  {
    $this->routes['POST'][$path] = $callback;
    $this->routes['POST'][$path]['middlewares'] = $middlewares;

    return $this;
  }


  public function resolve()
  {

    $uri = $this->request->getPath();
    $method = $this->request->getMethod();
    $callback = $this->routes[$method][$uri] ?? false;
    $middlewares = $callback['middlewares'] ?? [];



    if (is_array($callback)) {
      $class = $callback[0];
      $classMethod = $callback[1];

      foreach ($middlewares as $middleware) {
        (new MapMiddleware)->resolve($middleware, $this->request, $this->response);
      }

      if (class_exists($class)) {
        $controller = new $class();

        if (method_exists($controller, $classMethod)) {
          return call_user_func_array([$controller, $classMethod], [$this->request, $this->response]);
        }
      }
    }


    if (is_string($callback)) {
      return ViewManager::renderView($callback);
    }

    if (!$callback) {
      $this->response->setStatusCode(404);

      return ViewManager::renderView('_404');
    }

    if (is_callable($callback)) {
      return call_user_func($callback);
    }

  }



}