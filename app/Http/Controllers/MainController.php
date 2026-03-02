<?php

namespace App\Http\Controllers;

use App\Core\Request;
use App\Core\Response;

class MainController {

    public function index(Request $req, Response $res): Response {
        return $res->setContent('MVC Main Controller');
    }

    public function requestInfo(Request $req, Response $res): Response {
        return $res->json([
            'method: ' => $req->method(),
            'uri' => $req->uri()
        ]);
    }

    public function ping(Request $req, Response $res): Response {
        return $res->setContent('Pong 🏓');
    }
}