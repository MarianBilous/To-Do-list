<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Interfaces\RepositoryInterface;
use App\Models\Task;
use App\Observers\TaskObserver;
use App\Policies\TaskPolicy;
use App\Repositories\BaseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RepositoryInterface::class, BaseRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Task::observe(TaskObserver::class);
        Gate::policy(Task::class, TaskPolicy::class);
    }
}
