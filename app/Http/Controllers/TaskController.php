<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskFilterRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService,
                                protected TaskRepository $taskRepository)
    {}

    public function index(TaskFilterRequest $request)
    {
        $user = Auth::user();
        $tasks = $this->taskService->getFilteredTasks($user, $request->validated());

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        Gate::authorize('create', Task::class);

        return view('tasks.form');
    }

    public function store(TaskRequest $request)
    {
        Gate::authorize('create', Task::class);

        $this->taskService->createTaskForUser($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        Gate::authorize('view', $task);

        return view('tasks.form', compact('task'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        Gate::authorize('update', $task);

        $this->taskService->updateTaskForUser($request->validated(), $task);

        return redirect()->route('tasks.index')->with('success', 'Task updated!');
    }

    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);

        $this->taskService->deleteTask($task);

        return redirect()->route('tasks.index')->with('success', 'Task deleted!');
    }

    public function generatePublicLink(Task $task): JsonResponse
    {
        Gate::authorize('view', $task);

        $token = Str::random(32);
        $this->taskService->generateAccessTokenForTask($task, $token);

        return response()->json([
            'url' => route('tasks.viewPublicTask', $token)
        ]);
    }

    public function viewPublicTask(string $token)
    {
        $task = $this->taskService->getPublicTask($token);

        return view('tasks.view', compact('task'));
    }
}
