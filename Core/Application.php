<?php

namespace app\Core;



class Application
{

  public static $container;
  public array|null $user;
  public static string $ROOT_DIR;
  public Router $router;
  public static Application $app;
  public function __construct($rootPath)
  {
    self::$ROOT_DIR = $rootPath;
    self::$app = $this;
    $this->router = new Router();
    $this->user = self::$container->resolve('app\Core\Session')->get('user');
  }

  public function run()
  {
    try {
      $this->router->resolve();
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
  }



  public static function setContainer($container)
  {
    static::$container = $container;
  }

  public static function container()
  {
    return static::$container;
  }
  public static function bind($key, $resolver)
  {
    return static::$container->bind($key, $resolver);
  }
  public static function resolve($key)
  {
    return static::$container->resolve($key);
  }
}