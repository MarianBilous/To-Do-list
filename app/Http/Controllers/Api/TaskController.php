<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAllTasksForUser(Auth::id());
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request): JsonResponse
    {
        Gate::authorize('create', Task::class);

        $task = $this->taskService->createTaskForUser($request->validated());

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $task = $this->taskService->findByIdAndUserId($id, Auth::id());

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, int $id): JsonResponse
    {
        $task = $this->taskService->findByIdAndUserId($id, Auth::id());

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        Gate::authorize('update', $task);

        $updatedTask = $this->taskService->updateTaskForUser($request->validated(), $task);

        return response()->json($updatedTask);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $task = $this->taskService->findByIdAndUserId($id, Auth::id());

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        Gate::authorize('delete', $task);

        $this->taskService->deleteTask($task);

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
