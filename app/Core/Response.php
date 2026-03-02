<?php

namespace App\Core;

class Response {

    private int $statusCode = 200;
    private array $headers = [];
    private string $content = '';

    public function setStatusCode($statusCode): self {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setHeader(string $key, string $value): self {
        $this->headers[$key] = $value;
        return $this;
    }

    public function setContent(string $content): self {
        $this->content = $content;
        return $this;
    }

    public function json(array $data): self {
        $this->setHeader('Content-Type', 'application/json');
        $this->setContent(json_encode($data));
        return $this;
    }

    public function send(): void {
        http_response_code($this->statusCode);

        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }

        echo $this->content;
    }
}
