<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\Check;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.admin');
})->middleware(Check::class)->name('main');


// Auth
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(Check::class)->group(function () {
    // Users
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}', [UserController::class, 'delete'])->name('user.delete');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/users/search', [UserController::class, 'search'])->name('user.search');

    Route::get('/user-status/{user}', [UserController::class, 'status'])->name('user.status');

});

