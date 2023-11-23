<?php

namespace app\Core;


class Router
{

  private array $routes = [];
  public Request $request;
  public Response $response;

  public function __construct(Request $request, Response $response)
  {
    $this->request = $request;
    $this->response = $response;
  }

  public function get(string $path, string|callable|array $callback): self
  {
    $this->routes['GET'][$path] = $callback;
    return $this;
  }

  public function post(string $path, string|callable|array $callback): self
  {
    $this->routes['POST'][$path] = $callback;
    return $this;
  }

  public function resolve()
  {
    $uri = $this->request->getPath();
    $method = $this->request->getMethod();
    $callback = $this->routes[$method][$uri] ?? false;

    if (is_array($callback)) {
      $class = $callback[0];
      $classMethod = $callback[1];

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