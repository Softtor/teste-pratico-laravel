<?php

namespace App\Repositories;

use App\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryContract
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $filters = []): iterable
    {
        $query = $this->model->query();

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['relations'])) {
            $query->with($filters['relations']);
        }

        $sort = $filters['sort'] ?? 'desc';

        return $query->orderBy('created_at', $sort)->get();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($entity, array $data): bool
    {
        return $entity->update($data);
    }

    public function delete($entity): bool
    {
        return $entity->delete();
    }
}
