<?php

namespace app\Core;

use app\Core\Attributes\Route;
use app\Core\Middleware\MapMiddleware;
use ReflectionClass;
use ReflectionAttribute;

class Router
{

  public array $routes = [];
  public Request $request;
  public Response $response;

  public function __construct()
  {
    $this->request = Application::resolveContainer('app\Core\Request');
    $this->response = Application::resolveContainer('app\Core\Response');
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
        $controller = Application::resolveContainer($class);

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


  public function collectRoutes(array $controllersArray)
  {
    foreach ($controllersArray as $controller) {
      $class = new ReflectionClass($controller);


      foreach ($class->getMethods() as $method) {
        $attributes = $method->getAttributes(Route::class, ReflectionAttribute::IS_INSTANCEOF);


        foreach ($attributes as $attribute) {
          $route = $attribute->newInstance();


          $this->registerRoutes(
            $route->method,
            $route->path,
            [$controller, $method->getName()],
            $route->middleware ? [$route->middleware] : []
          );

        }
      }
    }

  }


  public function registerRoutes(string $method, string $path, string|callable|array $callback, ?array $middleware)
  {
    if (isset($this->routes[$method][$path])) {
      throw new \Exception('Route already exists');
    }

    $this->routes[$method][$path] = $callback;
    $this->routes[$method][$path]['middlewares'] = $middleware;

    return $this;
  }
}