<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->listCategories();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:categories,name'],
        ]);

        $category = $this->categoryService->createCategory($data);
        return response()->json($category, 201);
    }

    public function show(int $id)
    {
        $category = $this->categoryService->findCategory($id);

        if (!$category) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }

        return response()->json($category);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:categories,name,' . $id],
        ]);

        $category = $this->categoryService->findCategory($id);

        if (!$category) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }

        $updated = $this->categoryService->updateCategory($category, $data);

        if ($updated) {
            return response()->json($category);
        }

        return response()->json(['message' => 'Erro ao atualizar a categoria'], 500);
    }

    public function destroy(int $id)
    {
        $category = $this->categoryService->findCategory($id);

        if (!$category) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }

        $deleted = $this->categoryService->deleteCategory($category);

        if ($deleted) {
            return response()->json(['message' => 'Categoria excluída com sucesso']);
        }

        return response()->json(['message' => 'Erro ao excluir a categoria'], 500);
    }
}
