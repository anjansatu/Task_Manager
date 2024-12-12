<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\TaskController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\UserTaskcontroller;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\user\auth\AuthController;
use App\Http\Controllers\user\NotificationController;

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



Route::group(['prefix' => 'user', 'middleware' => [ 'auth']], function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('tasks/pending', [UserTaskcontroller::class, 'pendingTasks'])->name('user.tasks.pending');
    Route::get('tasks/in-progress', [UserTaskcontroller::class, 'inProgressTasks'])->name('user.tasks.inProgress');
    Route::get('tasks/completed', [UserTaskcontroller::class, 'completedTasks'])->name('user.tasks.completed');
    Route::get('tasks/showtask/{taskId}', [NotificationController::class, 'showtask'])->name('user.tasks.showtask');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('user.profile');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('user.changePassword');
});
