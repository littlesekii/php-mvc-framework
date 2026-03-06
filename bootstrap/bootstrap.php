<?php

use App\Core\Env;
use App\Core\ErrorHandler;
use App\Core\Router;

ErrorHandler::register();
Env::load(__DIR__.'/../.env');

$router = new Router();

require_once __DIR__ . '/../routes/routes.php';

return $router;