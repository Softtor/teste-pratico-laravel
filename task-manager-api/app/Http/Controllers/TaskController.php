<?php

namespace App\Http\Controllers;

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

    public function index(Request $request)
    {
        $filters = $request->only(['category_id', 'sort']);
        $tasks = $this->taskService->listTasks($filters);
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'min:5'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', Rule::in(['pending', 'in progress', 'done'])],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $task = $this->taskService->createTask($data);
        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $data = $request->validate([
            'title'       => ['sometimes', 'required', 'string', 'min:5'],
            'description' => ['nullable','string'],
            'status'      => ['sometimes', 'required', Rule::in(['pending', 'in progress', 'done'])],
            'category_id' => ['sometimes','required','exists:categories,id'],
        ]);
        $this->taskService->updateTask($task, $data);
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $this->taskService->deleteTask($task);
        return response()->json(['message' => 'Tarefa excluída com sucesso']);
    }
}
