<?php

namespace App\Core;

use App\Core\Exceptions\CoreException;
use App\Core\Exceptions\NotFoundException;
use App\Core\Exceptions\ValidationException;
use Exception;

class ExceptionHandler {

    public static function handle(Exception $e): Response {
        $response = new Response();
        
        switch(true) {
            case $e instanceof ValidationException:
                return $response->setStatusCode(400)
                    ->json(['error' => $e->getMessage() ?: '400 - Bad Request']);
            case $e instanceof NotFoundException:
                return$response->setStatusCode(404)
                    ->json(['error' => $e->getMessage() ?: '404 - Not Found']);
            case $e instanceof CoreException:
                return$response->setStatusCode(500)
                    ->json(['error' => $e->getMessage() ?: '500 - Internal Server Error']);
            default:
                return$response->setStatusCode(500)
                    ->json(['error' => $e->getMessage() ?: '500 - Internal Server Error']);
        }
    }

}