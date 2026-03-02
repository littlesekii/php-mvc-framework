<?php

use App\Http\Controllers\MainController;

$router->get("/", [MainController::class, 'index']);
$router->get("/api/ping", [MainController::class, 'ping']);

$router->get("/api/reqinfo", [MainController::class, 'requestInfo']);