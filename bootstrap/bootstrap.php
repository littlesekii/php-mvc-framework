<?php

use App\Core\Router;

$router = new Router();

require_once __DIR__ . '/../routes/routes.php';

return $router;