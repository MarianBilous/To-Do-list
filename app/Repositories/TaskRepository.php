<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository extends BaseRepository
{
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }

    public function createForUser(array $attributes): Task
    {
        return Auth::user()->tasks()->create($attributes);
    }

    public function updateForUser(array $attributes, Task $task): bool
    {
        return $task->update($attributes);
    }

    public function getByToken(string $token): Task|null
    {
        return $this->model->where('access_token', $token)->first();
    }

    public function getAllByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }

    public function findByIdAndUserId($id, $userId)
    {
        return $this->model->where('user_id', $userId)->find($id);
    }
}
