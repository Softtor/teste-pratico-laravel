<?php

namespace App\Repositories;

use App\Repositories\Contracts\Repository;

interface TaskRepositoryInterface extends Repository
{
    public function getAllByUser(int $userId, array $filters = []): iterable;
}
