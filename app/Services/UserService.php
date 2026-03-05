<?php

namespace App\Services;

use App\Repositories\UserRepository;
use RuntimeException;

class UserService {

    public function findById(int $id): array {
        
        $repository = new UserRepository();
        $user = $repository->findById($id);

        if(!$user) {
            throw new RuntimeException('User not found');
        }

        return $user;
    }
}