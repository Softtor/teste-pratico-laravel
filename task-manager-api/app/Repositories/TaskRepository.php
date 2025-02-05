<?php

namespace App\Repositories;

use App\Contracts\TaskRepositoryContract;
use App\Models\Task;
use App\Repositories\Repository;

class TaskRepository extends Repository implements TaskRepositoryContract
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function getTasksByUser(int $userId, array $filters = []): iterable
    {
        $filters['user_id'] = $userId;
        return $this->all($filters);
    }
}
