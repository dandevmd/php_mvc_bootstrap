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


  public static function resolveContainer($key)
  {
    return static::$container->resolve($key);
  }

  public static function getContainer(): Container
  {
    return static::container;
  }
}