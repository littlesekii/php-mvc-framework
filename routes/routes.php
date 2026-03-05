<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;

$router->get("/", [MainController::class, 'index']);
$router->get("/api/ping", [MainController::class, 'ping']);
$router->get("/api/reqinfo", [MainController::class, 'requestInfo']);
$router->get("/api/users/{id}", [MainController::class, 'user']);

$router->get("/users/{id}", [UserController::class, 'user']);
