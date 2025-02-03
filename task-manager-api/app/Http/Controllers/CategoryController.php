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

    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Lista todas as categorias",
     *     tags={"Categories"},
     *     @OA\Response(response=200, description="Lista de categorias retornada com sucesso")
     * )
     */
    public function index()
    {
        $categories = $this->categoryService->listCategories();
        return response()->json($categories);
    }

    /**
     * @OA\Post(
     *     path="/api/categories",
     *     summary="Cria uma nova categoria",
     *     tags={"Categories"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Trabalho")
     *         ),
     *     ),
     *     @OA\Response(response=201, description="Categoria criada com sucesso"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:categories,name'],
        ]);

        $category = $this->categoryService->createCategory($data);
        return response()->json($category, 201);
    }


    /**
     * @OA\Get(
     *     path="/api/categories/{id}",
     *     summary="Obtém uma categoria específica",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da categoria",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Categoria encontrada"),
     *     @OA\Response(response=404, description="Categoria não encontrada")
     * )
     */
    public function show(int $id)
    {
        $category = $this->categoryService->findCategory($id);

        if (!$category) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }

        return response()->json($category);
    }

    /**
     * @OA\Put(
     *     path="/api/categories/{id}",
     *     summary="Atualiza uma categoria",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da categoria",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Nova Categoria")
     *         ),
     *     ),
     *     @OA\Response(response=200, description="Categoria atualizada com sucesso"),
     *     @OA\Response(response=404, description="Categoria não encontrada")
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/categories/{id}",
     *     summary="Exclui uma categoria",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da categoria",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Categoria excluída com sucesso"),
     *     @OA\Response(response=404, description="Categoria não encontrada")
     * )
     */
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
