<?php

namespace App\Core;

class Router {

    private array $staticRoutes = [];
    private array $dynamicRoutes = [];

    public function get(string $uri, array $action): void {

        // if there is no curly braces opening its a static route
        if (strpos($uri, '{') === false) {
            $this->staticRoutes['GET'][$uri] = $action;
            return;
        }

        /* register the dynamic routes */

        preg_match_all('#\{([^}]+)\}#', $uri, $matches);
        $paramsNames = $matches[1];

        $pattern = preg_replace('#\{([^}]+)\}#', '([^/]+)', $uri);
        $pattern = "#^{$pattern}$#";

        $this->dynamicRoutes['GET'][] = [
            'uri' => $uri, 
            'pattern' => $pattern,
            'paramNames' => $paramsNames,
            'action' => $action
        ];

    }

    private function resolveStaticRoute(Request $request, array $action): void {
        [$controller, $method] = $action;
        $controller = new $controller;

        $response = $controller->$method($request);

        if ($response instanceof Response) {
            $response->send();
        }
    }

    private function resolveDynamicRoute(Request $request, array $action, array $params): void {
        [$controller, $method] = $action;
        $controller = new $controller;

        $response = call_user_func_array([$controller, $method], array_merge([$request], $params));

        if ($response instanceof Response) {
            $response->send();
        }
    }

    public function run(): void {

        $request = new Request();

        $method = $request->method();   
        $uri = $request->uri();

        if (isset($this->staticRoutes[$method][$uri])) {
            $action = $this->staticRoutes[$method][$uri];
            $this->resolveStaticRoute($request, $action);
            return;
        }

        $routes = $this->dynamicRoutes[$method] ?? [];

        foreach ($routes as $route) {        
            if (preg_match($route['pattern'], $uri, $matches)) {
                $paramValues = array_slice($matches, 1);
                $params = array_combine($route['paramNames'], $paramValues);

                $this->resolveDynamicRoute($request, $route['action'], $params);
                return;
            }    
        }
            
        (new Response())->setStatusCode(404)
            ->setContent("404 Not Found")
            ->send();        
    }
}