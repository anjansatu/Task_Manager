<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\TaskController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\auth\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\NotificationController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'getLogin'])->name('getLogin');
    Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// Route::get('/force-login-{id}', [AuthController::class, 'forceLogin'])->name('forceLogin');

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.getDashboard');

    Route::get('/task', [TaskController::class, 'index'])->name('admin.task.index');
    Route::get('/create-task', [TaskController::class, 'create'])->name('admin.task.create');
    Route::post('/create-task', [TaskController::class, 'postCreate'])->name('admin.task.postCreate');
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('admin.tasks.edit');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('admin.tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('admin.tasks.destroy');
    Route::get('tasks/pending', [TaskController::class, 'pendingTasks'])->name('admin.tasks.pending');
    Route::get('tasks/in-progress', [TaskController::class, 'inProgressTasks'])->name('admin.tasks.inProgress');
    Route::get('tasks/completed', [TaskController::class, 'completedTasks'])->name('admin.tasks.completed');
    Route::get('tasks/showtask/{taskId}', [TaskController::class, 'showtask'])->name('admin.tasks.showtask');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('admin.profile');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');


    // Users
    Route::get('users', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('users/{user}/show-tasks', [UserController::class, 'showTasks'])->name('admin.users.show_tasks');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    //Change User Type

    Route::get('/notify-user/{taskId}', [NotificationController::class, 'notifyUser'])->name('admin.notify.user');
});







