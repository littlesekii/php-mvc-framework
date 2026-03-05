<?php

namespace App\Services;

use App\Exceptions\EntityNotFoundException;
use App\Exceptions\InvalidArgumentException;
use App\Repositories\UserRepository;

class UserService {

    public function findById(int $id): array {
    
        if ($id < 1) {
            throw new InvalidArgumentException('Invalid User ID');
        }

        $repository = new UserRepository();
        $user = $repository->findById($id);

        if(!$user) {
            throw new EntityNotFoundException('User not found');
        }

        return $user;
    }
}