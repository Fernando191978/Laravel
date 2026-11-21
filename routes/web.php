<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Ruta para mostrar el formulario de login (GET)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Ruta para procesar el formulario (POST)
Route::post('/login', [AuthController::class, 'login']);

// Ruta para cerrar sesión (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta de prueba para el Home (protegida: solo entra si está logueado)
Route::get('/', function () {
    return "¡Bienvenido al sistema, " . auth()->user()->nombre . "!";
})->middleware('auth');