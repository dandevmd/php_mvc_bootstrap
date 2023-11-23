<?php

namespace app\Core;

use app\Core\Request;
use app\Database\DB;

class Application
{
  public DB $DB;
  public Response $response;
  public static string $ROOT_DIR;
  public Router $router;
  public Request $request;
  public static Application $app;
  public function __construct($rootPath)
  {
    self::$ROOT_DIR = $rootPath;
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
    $this->DB = new DB();
  }

  public function run()
  {
    try {
      $this->router->resolve();
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
  }
}