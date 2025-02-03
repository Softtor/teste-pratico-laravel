<?php

namespace App\Repositories;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getAll(): iterable;
    public function create(array $data): Category;
    public function findById(int $id): ?Category;
    public function update(Category $category, array $data): bool;
    public function delete(Category $category): bool;
}
