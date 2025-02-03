<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    protected TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function listTasks(array $filters = []): iterable
    {
        $user = Auth::user();
        return $this->taskRepository->getAllByUser($user->id, $filters);
    }

    public function createTask(array $data): Task
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;
        return $this->taskRepository->create($data);
    }

    public function findTask(int $id): ?Task
    {
        return $this->taskRepository->findById($id);
    }

    public function updateTask(Task $task, array $data): bool
    {
        return $this->taskRepository->update($task, $data);
    }

    public function deleteTask(Task $task): bool
    {
        return $this->taskRepository->delete($task);
    }
}
