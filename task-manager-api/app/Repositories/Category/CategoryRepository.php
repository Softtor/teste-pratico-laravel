<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Contracts\Repository;

class CategoryRepository implements Repository
{
    public function all(): iterable
    {
        return Category::all();
    }

    public function find(int $id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
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
