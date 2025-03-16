<?php

namespace App\Repositories;

use App\Models\TaskHistory;

class TaskHistoryRepository extends BaseRepository
{
    public function __construct(TaskHistory $model)
    {
        parent::__construct($model);
    }

    public function getAllByTask(int $id)
    {
        return $this->model->where('task_id', $id)->with('task')->get();
    }
}
