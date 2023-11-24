<?php

use app\Http\Controllers\HomeController;
use app\Http\Controllers\ContactController;
use app\Http\Controllers\auth\AuthController;


$router->get("/", [HomeController::class, "index"]);
$router->get("/contact", [ContactController::class, "index"]);
$router->post("/contact", [ContactController::class, "store"]);

$router->get("/login", [AuthController::class, "login"]);
$router->post("/attempt", [AuthController::class, "attempt"]);
$router->get("/logout", [AuthController::class, "logout"]);

$router->get("/register", [AuthController::class, "register"]);
$router->post("/register", [AuthController::class, "store"]);