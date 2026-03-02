<?php

namespace App\Core;

class Router {

    private array $routes = [];

    public function get(string $uri, array $action): void {
        $this->routes['GET'][$uri] = $action;
    }

    public function run(): void {

        $request = new Request();

        $method = $request->method();   
        $uri = $request->uri();

        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        [$controller, $method] = $action;
        $controller = new $controller;

        call_user_func([$controller, $method], $request);
    }
}