<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Services\UserService;

class UserController extends Controller {

    public function user(int $id) : Response {
        $service = new UserService();

        $res = $service->findById($id);
        return $this->json($res, 200);
    }
}