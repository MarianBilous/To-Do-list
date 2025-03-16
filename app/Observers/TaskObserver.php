<?php

namespace App\Observers;

use App\Models\Task;
use App\Repositories\TaskHistoryRepository;

class TaskObserver
{
    public function __construct(protected TaskHistoryRepository $historyRepository) {}

    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        $this->handle($task, 'created');
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        $this->handle($task, 'updated');
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        $this->handle($task, 'deleted');
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        $this->handle($task, 'restored');
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        $this->handle($task, 'forceDeleted');
    }

    /**
     * Handling all events (creation, update, deletion, etc.)
     */
    public function handle(Task $task, string $action): void
    {
        $data = [];

        switch ($action) {
            case 'created':
                $data = ['task_data' => $task->toArray()];
                break;

            case 'updated':
                $changes = $this->getUpdatedFields($task);
                $data = ['changes' => $changes];
                break;

            case 'deleted':
            case 'forceDeleted':
                $data = ['deleted_at' => now()];
                break;

            case 'restored':
                $data = ['restored_at' => now()];
                break;
        }

        $this->historyRepository->create([
            'task_id' => $task->id,
            'action' => $action,
            'data' => json_encode($data),
        ]);
    }

    /**
     * Get changed fields for update
     */
    private function getUpdatedFields(Task $task): array
    {
        $original = $task->getOriginal();

        return collect($task->getDirty())->mapWithKeys(fn ($newValue, $field) => [
            $field => [
                'old_value' => $original[$field] ?? null,
                'new_value' => $newValue
            ]
        ])->toArray();
    }
}
