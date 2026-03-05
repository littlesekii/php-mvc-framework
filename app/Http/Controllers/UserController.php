<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Core\View;
use App\Services\UserService;
use Exception;

class UserController extends Controller {

    public function user(int $id) : Response {
        $service = new UserService();
        try {

            $res = $service->findById($id);
            return $this->json($res, 200);

        } catch (Exception $e) {

            return (new Response())->setStatusCode(404)
                ->setContent(View::render('error.404'));
        }
    }
}