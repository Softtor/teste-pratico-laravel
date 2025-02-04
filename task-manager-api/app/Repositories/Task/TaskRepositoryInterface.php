<?php

namespace App\Repositories\Task;

use App\Contracts\Repository;

interface TaskRepositoryInterface extends Repository
{
    public function getAllByUser(int $userId, array $filters = []): iterable;
}
