<?php

namespace App\Core;

abstract class Controller {

    protected function view(string $view, array $data = []): Response {
        $content = View::render($view, $data);
        return (new Response())->setContent($content);
    }

    protected function json(array $data, int $statusCode = 200): Response {
        return (new Response())
            ->setStatusCode($statusCode)
            ->json($data);
    }
}