<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tasks', TaskController::class);
    Route::post('/tasks/{task}/generate-link', [TaskController::class, 'generatePublicLink'])->name('tasks.generateLink');
    Route::get('/task/{task}/history', [TaskHistoryController::class, 'index'])->name('tasks.history.index');
    Route::get('/task/history/{history}', [TaskHistoryController::class, 'show'])->name('tasks.history.show');
});

Route::get('/public/tasks/{token}', [TaskController::class, 'viewPublicTask'])->name('tasks.viewPublicTask');

require __DIR__.'/auth.php';
