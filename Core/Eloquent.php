<?php
namespace app\Core;


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Eloquent
{
  public static function init(): void
  {
    $capsule = new Capsule;

    $capsule->addConnection([
      'driver' => 'mysql',
      'host' => 'localhost',
      'database' => 'php_mvc_bootstrap',
      'username' => $_ENV['DB_USER'] ?? 'root',
      'password' => $_ENV['DB_PASSWORD'] ?? '',
    ]);

    $capsule->setEventDispatcher(new Dispatcher(new Container));
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
  }
}