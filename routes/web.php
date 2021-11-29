<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('users.')->prefix('users')->group(function () {
    // Реализовать метод получения всех пользователей
    Route::get('/', [UserController::class, 'index'])->name('index');
    // Реализовать метод получения одного пользователя
    Route::get('{id}', [UserController::class, 'show'])->name('show');
    // Реализовать метод изменения одного пользователя
    Route::put('update/{id}', [UserController::class, 'update'])->name('update');
    // Реализовать метод изменения нескольких пользователей по id
    Route::post('update_many_users', [UserController::class, 'updateManyUsers'])->name('update_many_users');
    // Реализовать метод удаления одного пользователя
    Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('delete');
    // Реализовать метод удаления нескольких пользователей по id
    Route::post('delete_many_users', [UserController::class, 'destroyManyUsers'])->name('delete_many_users');
});

