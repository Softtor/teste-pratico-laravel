<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="Lista todas as tarefas",
     *     tags={"Tasks"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\Response(response=200, description="Lista de tarefas retornada com sucesso")
     * )
     */
    public function index(Request $request)
    {
        $filters = $request->only(['category_id', 'sort']);
        $tasks = $this->taskService->listTasks($filters);
        return response()->json($tasks);
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     summary="Cria uma nova tarefa",
     *     tags={"Tasks"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "status", "category_id"},
     *             @OA\Property(property="title", type="string", example="Comprar leite"),
     *             @OA\Property(property="description", type="string", example="Comprar leite na padaria"),
     *             @OA\Property(property="status", type="string", enum={"pending", "in progress", "done"}),
     *             @OA\Property(property="category_id", type="integer", example=1)
     *         ),
     *     ),
     *     @OA\Response(response=201, description="Tarefa criada com sucesso"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function store(TaskRequest $request)
    {
        $task = $this->taskService->createTask($request->validated());
        return response()->json($task, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/{task}",
     *     summary="Obtém uma tarefa específica",
     *     tags={"Tasks"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\Parameter(
     *         name="task",
     *         in="path",
     *         required=true,
     *         description="ID da tarefa",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Tarefa encontrada"),
     *     @OA\Response(response=403, description="Usuário não autorizado a visualizar esta tarefa"),
     *     @OA\Response(response=404, description="Tarefa não encontrada")
     * )
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return response()->json($task);
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{task}",
     *     summary="Atualiza uma tarefa",
     *     tags={"Tasks"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\Parameter(
     *         name="task",
     *         in="path",
     *         required=true,
     *         description="ID da tarefa",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Novo título"),
     *             @OA\Property(property="status", type="string", enum={"pending", "in progress", "done"}),
     *             @OA\Property(property="category_id", type="integer", example=1)
     *         ),
     *     ),
     *     @OA\Response(response=200, description="Tarefa atualizada com sucesso"),
     *     @OA\Response(response=403, description="Usuário não autorizado a modificar esta tarefa"),
     *     @OA\Response(response=404, description="Tarefa não encontrada")
     * )
     */
    public function update(TaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);
        $this->taskService->updateTask($task, $request->validated());
        return response()->json($task);
    }


    /**
     * @OA\Delete(
     *     path="/api/tasks/{task}",
     *     summary="Exclui uma tarefa",
     *     tags={"Tasks"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\Parameter(
     *         name="task",
     *         in="path",
     *         required=true,
     *         description="ID da tarefa",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Tarefa excluída com sucesso"),
     *     @OA\Response(response=403, description="Usuário não autorizado a excluir esta tarefa"),
     *     @OA\Response(response=404, description="Tarefa não encontrada")
     * )
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $this->taskService->deleteTask($task);
        return response()->json(['message' => 'Tarefa excluída com sucesso']);
    }
}
