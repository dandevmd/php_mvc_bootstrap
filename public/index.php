<?php
declare(strict_types=1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use app\Core\Application;
use app\Http\Controllers\HomeController;
use app\Http\Controllers\ContactController;
use app\Http\Controllers\auth\AuthController;

require_once __DIR__ . "/../vendor/autoload.php";
$rootPath = dirname(__DIR__);
$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->load();
require_once(__DIR__ . "/../bootstrap.php");


$app = new Application($rootPath);
$router = $app->router;

$router->collectRoutes([
  HomeController::class,
  ContactController::class,
  AuthController::class
]);



$app->run();