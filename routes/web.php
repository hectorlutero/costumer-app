<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});

Route::group(['middleware' => ['auth', 'role:administrator']], function () {
    Route::get('/dashboard/adminArea', 'App\Http\Controllers\DashboardController@adminArea')->name('dashboard.adminArea');
});

Route::group(['middleware' => ['auth', 'role:administrator']], function () {
    Route::get('/dashboard/becomeUser', 'App\Http\Controllers\DashboardController@becomeUser')->name('dashboard.becomeUser');
});

Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/dashboard/profile', 'App\Http\Controllers\DashboardController@userArea')->name('dashboard.userArea');
});
Route::group(['middleware' => ['auth', 'role:user']], function () {
    Route::get('/dashboard/becomeAdmin', 'App\Http\Controllers\DashboardController@becomeAdmin')->name('dashboard.becomeAdmin');
});

require __DIR__.'/auth.php';
