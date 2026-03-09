<?php

namespace App\Core;

class Request {

    private array $get;
    private array $post;
    private array $body;
    private array $server;

    public function __construct() {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;

        $rawBodyData = file_get_contents('php://input');
        $data = json_decode($rawBodyData, true);
        $this->body = $data ?? [];
    }

    public function method(): string {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }

    public function uri(): string {
        return parse_url(
            $this->server['REQUEST_URI'] ?? '/', 
            PHP_URL_PATH
        );
    }

    public function input(string $key, $default = null): mixed {
        return $this->body[$key] ?? $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    public function all(): array {
        return array_merge($this->get, $this->post);
    }
}