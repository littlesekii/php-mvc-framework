<?php

namespace App\Core;

class Router {

    private array $routes = [];

    public function get(string $uri, array $action): void {
        $this->routes['GET'][$uri] = $action;
    }

    public function run(): void {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';   
        $uri = parse_url(
            $_SERVER['REQUEST_URI'] ?? '/', 
            PHP_URL_PATH
        );

        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        [$controller, $method] = $action;
        $controller = new $controller;

        call_user_func([$controller, $method]);
    }
}