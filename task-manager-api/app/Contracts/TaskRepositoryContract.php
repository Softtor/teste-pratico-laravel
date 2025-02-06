<?php

namespace App\Contracts;

use App\Contracts\RepositoryContract;

interface TaskRepositoryContract extends RepositoryContract
{
    public function getTasksByUser(int $userId, array $filters = []): iterable;
}
