<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskHistory;
use App\Repositories\TaskHistoryRepository;

class TaskHistoryController extends Controller
{
    public function __construct(protected TaskHistoryRepository $taskRepository) {}

    public function index(Task $task)
    {
        if (auth()->id() !== $task->user_id) {
            abort(403, 'Access is denied');
        }

        $taskHistories = $this->taskRepository->getAllByTask($task->id);

        return view('tasks.history', compact('taskHistories', 'task'));
    }

    public function show(TaskHistory $history)
    {
        return view('tasks.show_change', compact('history'));
    }
}
