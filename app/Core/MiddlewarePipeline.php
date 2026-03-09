<?php

namespace App\Core;

class MiddlewarePipeline {

    protected array $middlewares = [];

    public function add(string $middleware) {
        $this->middlewares[] = $middleware;
    }

    public function handle(Request $request, callable $destination) {
        $pipeline = array_reduce(
            array_reverse($this->middlewares),
            function ($next, $middleware) {
                return function ($request) use ($next, $middleware) {
                    $instance = new $middleware;

                    return $instance->handle($request, $next);
                };
            },
            $destination
        );
        return $pipeline($request);
    }

}