<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Services\UserService;

class UserController extends Controller {

    private UserService $service;

    public function __construct(UserService $service) {
        $this->service = $service;
    }

    public function user(int $id) : Response {
        $res = $this->service->findById($id);
        return $this->json($res, 200);
    }
}