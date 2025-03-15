<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskReminderNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendTaskReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:send-task-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $tasks = Task::where('deadline', $tomorrow)
            ->where('status', '!=', 'done')
            ->with('user')
            ->get();

        foreach ($tasks as $task) {
            $task->user->notify(new TaskReminderNotification($task));

            Log::info("Sent reminder for task ID: {$task->id} to user {$task->user->email}");
        }

        $this->info($tasks->count() . " reminders sent.");
    }
}
