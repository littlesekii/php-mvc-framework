<?php

namespace App\Repositories;

class UserRepository {

    public function findById(int $id): ?array {
        $users = [
            ['id' => 1, 'name' => 'Davi'],
            ['id' => 2, 'name' => 'Flávia'],
        ];

        foreach ($users as $user) {
            if ($user['id'] === $id)
                return $user;
        }

        return null;
    }
}