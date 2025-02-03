<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllByUser(int $userId, array $filters = []): iterable
    {
        $query = Task::query()->where('user_id', $userId);
        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        $sort = $filters['sort'] ?? 'desc';
        return $query->orderBy('created_at', $sort)->get();
    }

    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function findById(int $id): ?Task
    {
        return Task::find($id);
    }

    public function update(Task $task, array $data): bool
    {
        return $task->update($data);
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }
}
