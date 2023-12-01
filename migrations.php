<?php

use app\Core\Application;


require_once __DIR__ . "/vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
require_once("bootstrap.php");

$app = new Application(__DIR__);


$app::resolveContainer('app\Core\Database')->runMigrations();