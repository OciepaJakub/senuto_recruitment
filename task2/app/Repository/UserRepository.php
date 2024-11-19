<?php

namespace App\Repository;

use App\Database\DatabaseConnection;
use App\Models\User;

class UserRepository implements UserRepositoryInterface {
    private DatabaseConnection $dbConnection;

    public function __construct(DatabaseConnection $dbConnection) {
        $this->dbConnection = $dbConnection;
    }

    public function findById(int $id): ?User {
        $query = $this->dbConnection->getConnection()->prepare('SELECT * FROM users WHERE id = :id');
        $query->execute(['id' => $id]);

        $data = $query->fetch(\PDO::FETCH_ASSOC);
        
        if ($data) {
            return new User($data['id'], $data['name'], $data['email'], $data['isSubscriber']);
        }

        return null;
    }

    public function save(User $user): void {}
}
