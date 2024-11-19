<?php

namespace App\Repository;

use App\Models\User;

interface UserRepositoryInterface {
    public function findById(int $id): ?User;
    public function save(User $user): void;
}
