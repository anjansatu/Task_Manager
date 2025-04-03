<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\SsnController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\UserDepositController;
use App\Http\Controllers\user\ProfileController;
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
    return view('landing');
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/signin', [AuthController::class, 'postLogin'])->name('post.login');
Route::get('/signup', [AuthController::class, 'signup'])->name('signUp');
Route::post('/signup', [AuthController::class, 'postSignUp'])->name('post.signUp');
Route::get('/signout', [AuthController::class, 'signOut'])->name('signout');



Route::group(['prefix' => 'user', 'middleware' => [ 'auth']], function () {

    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/deposits', [UserDepositController::class, 'index'])->name('deposits.index');
    Route::get('/deposits/create', [UserDepositController::class, 'create'])->name('deposits.create');
    Route::post('/deposits', [UserDepositController::class, 'store'])->name('deposits.store');

    Route::get('/profile', [ProfileController::class, 'profile'])->name('user.profile');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('user.changePassword');

    Route::get('ssn-index', [SsnController::class, 'index'])->name('user.ssn.index');
    Route::post('/ssn/store-order', [SsnController::class, 'storeOrder'])->name('ssn.storeOrder');

    Route::get('purchase-ssn', [SsnController::class, 'history'])->name('user.ssn.purchase');


    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    
    


});
