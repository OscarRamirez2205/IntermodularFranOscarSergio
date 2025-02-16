<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;


Route::withoutMiddleware(['auth', 'checkRol:Administrador'])->group(function () {

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware(['auth', 'checkRol:Administrador'])->group(function () {
    Route::get('/', function () {
        return redirect('/');
    });
});

