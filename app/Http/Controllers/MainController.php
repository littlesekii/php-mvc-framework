<?php

namespace App\Http\Controllers;

use App\Core\Request;

class MainController {

    public function index(Request $req): void {
        echo 'MVC Main Controller';
    }

    public function requestInfo(Request $req): void {
        header('Content-Type: application/json');
        echo json_encode([
            'method: ' => $req->method(),
            'uri' => $req->uri()
        ]);
    }

    public function ping(Request $req): void {
        echo 'Pong 🏓';
    }
}