<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\Task\TaskRepositoryInterface;

class TaskService
{
    protected TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Retorna todas as tarefas.
     *
     * @return iterable
     */
    public function getAllTasks(): iterable
    {
        return $this->taskRepository->all();
    }

    /**
     * Busca uma tarefa pelo ID.
     *
     * @param int $id
     * @return Task|null
     */
    public function getTaskById(int $id): ?Task
    {
        return $this->taskRepository->find($id);
    }

    /**
     * Cria uma nova tarefa.
     *
     * @param array $data
     * @return Task
     */
    public function createTask(array $data): Task
    {
        return $this->taskRepository->create($data);
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
        return $this->taskRepository->update($task, $data);
    }

    /**
     * Remove uma tarefa.
     *
     * @param Task $task
     * @return bool
     */
    public function deleteTask(Task $task): bool
    {
        return $this->taskRepository->delete($task);
    }

    /**
     * Retorna todas as tarefas de um usuário, com possibilidade de filtros.
     *
     * @param int $userId
     * @param array $filters
     * @return iterable
     */
    public function getTasksByUser(int $userId, array $filters = []): iterable
    {
        return $this->taskRepository->getAllByUser($userId, $filters);
    }
}
