<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class MainController extends Controller {

    public function index(Request $req): Response {
        return $this->view('home.index', ['name' => 'PHP MVC Framework']);
    }

    public function requestInfo(Request $req): Response {
        return $this->json([
            'method: ' => $req->method(),
            'uri' => $req->uri()
        ]);
    }

    public function ping(Request $req): Response {
        return (new Response())->setContent('Pong 🏓');
    }

    public function user(Request $req, $id): Response {
        return (new Response())->setContent(strval($id));
    }
}