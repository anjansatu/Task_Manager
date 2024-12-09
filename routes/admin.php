<?php

use Illuminate\Support\Facades\Route;
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
});







