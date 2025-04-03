<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminSsnConteroller;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AdminPriceController;
use App\Http\Controllers\AdminDepositController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\auth\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\ExcelImportController;
use App\Http\Controllers\admin\NotificationController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'getLogin'])->name('getLogin');
    Route::post('login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// Route::get('/force-login-{id}', [AuthController::class, 'forceLogin'])->name('forceLogin');

Route::group(['middleware' => ['auth:admin']], function () {
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/clear-cash', [DashboardController::class, 'clearCash'])->name('clear.cash');



        // Profile
        Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
        Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');

        // Users
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('{user}/show-tasks', [UserController::class, 'showTasks'])->name('show_tasks');
            Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
        });

        // Deposits
        Route::prefix('deposits')->name('deposits.')->group(function () {
            Route::get('/', [AdminDepositController::class, 'index'])->name('index');
            Route::get('{id}', [AdminDepositController::class, 'show'])->name('show');
            Route::put('{id}/status', [AdminDepositController::class, 'updateStatus'])->name('updateStatus');


        });

        Route::get('/deposit-method', [AdminDepositController::class, 'depositMethods'])->name('method');
        Route::post('/deposit-methods', [AdminDepositController::class, 'storeDepositMethods'])->name('storeDepositMethods');
        Route::delete('/deposit-methods/{id}', [AdminDepositController::class, 'destroyDepositMethods'])->name('destroyDepositMethods');
        // Notifications
        Route::get('/notify-user/{taskId}', [NotificationController::class, 'notifyUser'])->name('notify.user');

        //SSN
        Route::resource('ssns', AdminSsnConteroller::class);
        Route::post('/import-excel', [ExcelImportController::class, 'importExcel'])->name('excel.import');

        Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

        Route::get('force-login-{id}', [AuthController::class, 'forceLogin'])->name('forceLogin');

        Route::get('price-index', [AdminPriceController::class, 'index'])->name('price.index');
        Route::get('price-create', [AdminPriceController::class, 'create'])->name('price.create');
        Route::post('price-store', [AdminPriceController::class, 'store'])->name('price.store');
        Route::get('price-edit/{price}', [AdminPriceController::class, 'edit'])->name('price.edit');
        Route::put('price-update/{price}', [AdminPriceController::class, 'update'])->name('price.update');
        Route::delete('price-destroy/{price}', [AdminPriceController::class, 'destroy'])->name('price.destroy');

    });
});







