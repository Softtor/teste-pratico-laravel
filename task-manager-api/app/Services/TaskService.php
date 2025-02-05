<?php

namespace App\Services;

use App\Contracts\TaskRepositoryContract;
use App\Models\Task;

class TaskService
{
    protected TaskRepositoryContract $repository;

    public function __construct(TaskRepositoryContract $taskRepository)
    {
        $this->repository = $taskRepository;
    }

    /**
     * Retorna todas as tarefas com possibilidade de filtros.
     *
     * @param array $filters
     * @return iterable
     */
    public function getAllTasks(array $filters = []): iterable
    {
        return $this->repository->all($filters);
    }

    /**
     * Busca uma tarefa pelo ID.
     *
     * @param int $id
     * @return Task|null
     */
    public function getTaskById(int $id): ?Task
    {
        return $this->repository->find($id);
    }

    /**
     * Cria uma nova tarefa.
     *
     * @param array $data
     * @return Task
     */
    public function createTask(array $data): Task
    {
        return $this->repository->create($data);
    }

    /**
     * Atualiza uma tarefa existente.
     *
     * @param Task $task
     * @param array $data
     * @return bool
     */
    public function updateTask(Task $task, array $data): bool
    {
        return $this->repository->update($task, $data);
    }

    /**
     * Remove uma tarefa.
     *
     * @param Task $task
     * @return bool
     */
    public function deleteTask(Task $task): bool
    {
        return $this->repository->delete($task);
    }
}
