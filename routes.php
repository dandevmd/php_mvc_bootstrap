<?php

use app\Http\Controllers\HomeController;
use app\Http\Controllers\ContactController;
use app\Http\Controllers\auth\AuthController;


$router->get("/", [HomeController::class, "index"]);
$router->get("/contact", [ContactController::class, "index"]  , ['auth']);
$router->post("/contact", [ContactController::class, "store"] , ['auth']);

$router->get("/login", [AuthController::class, "login"], ["guest"]);
$router->post("/attempt", [AuthController::class, "attempt"], ["guest"]);
$router->get("/logout", [AuthController::class, "logout"], ["auth"]);

$router->get("/register", [AuthController::class, "register"], ["guest"]);
$router->post("/register", [AuthController::class, "store"], ["guest"]);