<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::post('login', [UserAuthController::class, 'login']);
Route::post('register', [UserAuthController::class, 'create'])->name('register');
Route::post('check', [UserAuthController::class, 'check'])->name('auth.check');
Route::post('logout', [UserAuthController::class, 'logout'])->name('logout');
Route::get('dashboard', [UserAuthController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
Route::put('changeRole/{$id}', [DashboardController::class, 'changeRole'])->name('changeRole');
Route::get('adminArea', [DashboardController::class, 'adminArea'])->name('adminArea');



require __DIR__.'/auth.php';
