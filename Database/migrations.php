<?php

use app\Core\Application;


require_once __DIR__ . "/../vendor/autoload.php";
$rootPath = dirname(__DIR__);
$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->load();

$app = new Application(dirname(__DIR__));

$app->DB->runMigrations();