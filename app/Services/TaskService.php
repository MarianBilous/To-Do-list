<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskService
{
    public function __construct(protected TaskRepository $taskRepository) {}

    public function getFilteredTasks($user, array $filters)
    {
        $tasks = $user->tasks();

        if (!empty($filters['status'])) {
            $tasks->where('status', $filters['status']);
        }

        if (!empty($filters['priority'])) {
            $tasks->where('priority', $filters['priority']);
        }

        if (!empty($filters['deadline_from']) && !empty($filters['deadline_to'])) {
            $tasks->whereBetween('deadline', [$filters['deadline_from'], $filters['deadline_to']]);
        } elseif (!empty($filters['deadline_from'])) {
            $tasks->whereDate('deadline', '>=', $filters['deadline_from']);
        } elseif (!empty($filters['deadline_to'])) {
            $tasks->whereDate('deadline', '<=', $filters['deadline_to']);
        }

        if (!empty($filters['sort_by'])) {
            $sortBy = $filters['sort_by'];

            $tasks->orderBy($sortBy);
        } else {
            $tasks->orderBy('deadline');
        }

        return $tasks->paginate(10);
    }

    public function getAllTasksForUser($userId)
    {
        return $this->taskRepository->getAllByUserId($userId);
    }

    public function createTaskForUser(array $attributes): Task
    {
        return $this->taskRepository->createForUser($attributes);
    }

    public function updateTaskForUser(array $attributes, Task $task): bool
    {
        return $this->taskRepository->updateForUser($attributes, $task);
    }

    public function deleteTask(Task $task): bool
    {
        return $task->delete();
    }

    public function generateAccessTokenForTask(Task $task, string $token): void
    {
        $task->update([
            'access_token' => $token,
            'access_token_expires_at' => now()->addHours(1),
        ]);
    }

    public function getPublicTask(string $token): Task
    {
        $task = $this->taskRepository->getByToken($token);

        if (!$task) {
            abort(404);
        }

        if ($task->access_token !== $token || $task->access_token_expires_at < now()) {
            abort(404, 'Invalid or expired token');
        }

        return $task;
    }

    public function findByIdAndUserId(int $id, int $userId): ?Task
    {
        return $this->taskRepository->findByIdAndUserId($id, $userId);
    }
}
