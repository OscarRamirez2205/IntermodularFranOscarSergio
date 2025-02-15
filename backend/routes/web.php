<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('admin');

Route::resource('usuarios', UserController::class);
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');

Route::get('/login', [LoginController::class, "showLogin"])->name('login');
Route::get('/loginAdmin', [LoginController::class, "log"])->name('log');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
