<?php

namespace App\Http\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;

class MainController {

    public function index(Request $req, Response $res): Response {
        $content = View::render('home.sindex', [
            'name' => 'PHP MVC Framework'
        ]);
        return $res->setContent($content);
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