<?php

namespace App\Repositories;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function getAllByUser(int $userId, array $filters = []): iterable;
    public function create(array $data): Task;
    public function findById(int $id): ?Task;
    public function update(Task $task, array $data): bool;
    public function delete(Task $task): bool;
}
