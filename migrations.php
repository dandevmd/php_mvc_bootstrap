<?php

use dandevmd\mvccore\Application;


require_once __DIR__ . "/vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = new Application(__DIR__);

$app->DB->runMigrations();