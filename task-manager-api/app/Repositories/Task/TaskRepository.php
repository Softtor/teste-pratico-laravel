<?php

namespace App\Repositories\Task;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{

    public function all(): iterable
    {
        return Task::all();
    }

    public function find(int $id)
    {
        return Task::find($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update($entity, array $data): bool
    {
        return $entity->update($data);
    }

    public function delete($entity): bool
    {
        return $entity->delete();
    }

    public function getAllByUser(int $userId, array $filters = []): iterable
    {
        $query = Task::query()->where('user_id', $userId);
        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        $sort = $filters['sort'] ?? 'desc';
        return $query->orderBy('created_at', $sort)->get();
    }

    public function findById(int $id)
    {
        return Task::find($id);
    }
}
