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
    public function getCategoryById(int $id): ?Category
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
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateCategory(int $id, array $data): bool
    {
        $category = $this->getCategoryById($id);

        if (!$category) {
            return false;
        }

        return $this->repository->update($category, $data);
    }

    /**
     * Remove uma categoria.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCategory(int $id): bool
    {
        $category = $this->getCategoryById($id);

        if (!$category) {
            return false;
        }

        return $this->repository->delete($category);
    }
}
