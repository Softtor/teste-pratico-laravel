<?php

namespace App\Services;

use App\Repositories\Contracts\Repository;
use App\Models\Category;

class CategoryService
{
    /**
     * @var Repository
     */
    protected Repository $categoryRepository;

    /**
     * Construtor com injeção de dependência do repositório de Category.
     *
     * @param Repository $categoryRepository
     */
    public function __construct(Repository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Retorna todas as categorias.
     *
     * @return iterable
     */
    public function getAllCategories(): iterable
    {
        return $this->categoryRepository->all();
    }

    /**
     * Busca uma categoria pelo ID.
     *
     * @param int $id
     * @return Category|null
     */
    public function getCategoryById(int $id): ?Category
    {
        return $this->categoryRepository->find($id);
    }

    /**
     * Cria uma nova categoria.
     *
     * @param array $data
     * @return Category
     */
    public function createCategory(array $data): Category
    {
        return $this->categoryRepository->create($data);
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

        return $this->categoryRepository->update($category, $data);
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

        return $this->categoryRepository->delete($category);
    }
}
