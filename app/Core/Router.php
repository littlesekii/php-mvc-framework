<?php

namespace App\Core;

class Router {

    private array $routes = [];

    public function get(string $uri, array $action): void {
        $this->routes['GET'][$uri] = $action;
    }

    public function run(): void {

        $request = new Request();
        $response = new Response();

        $method = $request->method();   
        $uri = $request->uri();

        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            $response->setStatusCode(404)
                ->setContent("404 Not Found")
                ->send();

            return;
        }

        [$controller, $method] = $action;
        $controller = new $controller;

        $result = call_user_func([$controller, $method], $request, $response);

        if ($result instanceof Response) {
            $result->send();
        }
    }
}