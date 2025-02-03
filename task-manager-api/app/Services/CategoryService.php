<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;

class CategoryService
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function listCategories(): iterable
    {
        return $this->categoryRepository->getAll();
    }

    public function createCategory(array $data): Category
    {
        return $this->categoryRepository->create($data);
    }

    public function findCategory(int $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }
}
