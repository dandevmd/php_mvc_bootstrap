<?php

use app\Core\Application;


require_once __DIR__ . "/vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = new Application(__DIR__);

$app::$container->resolve('app\Core\Database')->runMigrations();