<?php

namespace App\Services;

use App\Contracts\CategoryRepositoryContract;
use App\Repositories\Repository;
use App\Models\Category;

class CategoryService
{
    protected CategoryRepositoryContract $repository;

    public function __construct(CategoryRepositoryContract $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }


    /**
     * Retorna todas as categorias com possibilidade de filtros.
     *
     * @param array $filters
     * @return iterable
     */
    public function getAllCategories(array $filters = []): iterable
    {
        return $this->repository->all($filters);
    }

    /**
     * Busca uma categoria pelo ID.
     *
     * @param int $id
     * @return Category|null
     */
    public function getCategory(int $id): ?Category
    {
        return $this->repository->find($id);
    }

    /**
     * Cria uma nova categoria.
     *
     * @param array $data
     * @return Category
     */
    public function createCategory(array $data): Category
    {
        return $this->repository->create($data);
    }

    /**
     * Atualiza uma categoria existente.
     *
     * @param Category
     * @param array $data
     * @return bool
     */
    public function updateCategory(Category $category, array $data): bool
    {
        return tap($category)->update($data)->save();
    }


    /**
     * Remove uma categoria.
     *
     * @param Category
     * @return bool
     */
    public function deleteCategory(Category $category): bool
    {
        return $this->repository->delete($category);
    }
}
