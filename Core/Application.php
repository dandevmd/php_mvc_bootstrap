<?php

namespace app\Core;

use app\Core;
use app\Core\Session;
use app\Core\Request;

class Application
{
  public array|null $user;
  public Session $session;
  public Database $DB;
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
    $this->DB = new Database();
    $this->session = new Session();
    $this->user = $this->session->get('user') ?? null;
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