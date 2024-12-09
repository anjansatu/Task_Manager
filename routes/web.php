<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\TaskController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\user\auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);


Route::get('/signin', [AuthController::class, 'index'])->name('login');
Route::post('/signin', [AuthController::class, 'postLogin'])->name('post.login');
Route::get('/signup', [AuthController::class, 'signup'])->name('signUp');
Route::post('/signup', [AuthController::class, 'postSignUp'])->name('post.signUp');
Route::get('/signout', [AuthController::class, 'signOut'])->name('signout');
Route::get('/verify-email/{code}', [AuthController::class, 'userVerifyEmail'])->name('userVerifyEmail');
Route::get('/forget-password', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('/forget-password', [AuthController::class, 'sendForgetPasswordMail'])->name('sendForgetPasswordMail');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('/update-password', [AuthController::class, 'changePasswordUser'])->name('changePasswordUser');


Route::group(['prefix' => 'user', 'middleware' => [ 'auth']], function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    Route::get('tasks', [TaskController::class, 'index'])->name('admin.tasks.index');
    Route::get('tasks/pending', [TaskController::class, 'pendingTasks'])->name('tasks.pending');
    Route::get('tasks/in-progress', [TaskController::class, 'inProgressTasks'])->name('tasks.inProgress');
    Route::get('tasks/completed', [TaskController::class, 'completedTasks'])->name('tasks.completed');
    Route::get('tasks/showtask/{taskId}', [NotificationController::class, 'showtask'])->name('tasks.showtask');
    Route::patch('/tasks/{task}/update-status', [TaskController::class,'updateStatus'])->name('tasks.update-status');

});
