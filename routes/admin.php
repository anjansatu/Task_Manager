<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\TaskController;
use App\Http\Controllers\admin\auth\AuthController;
use App\Http\Controllers\admin\DashboardController;

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
    // Users
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/{user}/show-tasks', [UserController::class, 'showTasks'])->name('admin.users.show_tasks');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    //Change User Type
    Route::patch('/admin/users/{user}/update-type', [UserController::class, 'updateType'])->name('admin.users.update-type');
});







