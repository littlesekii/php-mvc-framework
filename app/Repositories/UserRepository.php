<?php

namespace App\Repositories;

class UserRepository {

    public function findById(int $id): ?array {
        $json = file_get_contents(__DIR__ . '/../../database/users.json');
        $users = json_decode($json, true) ?? [];

        foreach ($users as $user) {
            if ($user['id'] === $id)
                return $user;
        }

        return null;
    }

    public function save(int $id, string $name): ?array {
        $json = file_get_contents(__DIR__ . '/../../database/users.json');
        $users = json_decode($json, true) ?? [];

        $users[] = ['id' => $id, 'name' => $name];

        file_put_contents(__DIR__ . '/../../database/users.json', json_encode($users));

        return ['id' => $id, 'name' => $name];
    }
}