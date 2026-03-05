<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Exceptions\EntityNotFoundException;
use App\Exceptions\InvalidArgumentException;
use App\Services\UserService;

class UserController extends Controller {

    public function user(int $id) : Response {
        $service = new UserService();
        try {

            $res = $service->findById($id);
            return $this->json($res, 200);

        } catch (EntityNotFoundException $e) {
            return (new Response())->setStatusCode(404)
                ->json(['error' => $e->getMessage()], 404);
        } catch (InvalidArgumentException $e) {
            return (new Response())->setStatusCode(400)
                ->json(['error' => $e->getMessage()], 400);
        }
    }
}