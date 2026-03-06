<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Env;
use App\Core\Request;
use App\Core\Response;
use Exception;

class MainController extends Controller {

    public function index(): Response {
        return $this->view('home.index', ['name' => Env::get('PROJECT_NAME')]);
    }

    public function requestInfo(Request $req): Response {
        return $this->json([
            'method: ' => $req->method(),
            'uri' => $req->uri()
        ]);
    }

    public function ping(): Response {
        return (new Response())->setContent('Pong 🏓');
    }

    public function exception(): Response {
        throw new Exception();
    }

    public function user(int $id): Response {
        return (new Response())->setContent(strval($id));
    }
}