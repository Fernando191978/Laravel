<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

// Mostrar y procesar el formulario de inicio de sesión.
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Cerrar sesión.
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Mostrar el saludo de prueba.
Route::get('/', function () {
    return '¡Bienvenido al sistema, ' . auth()->user()->nombre . '!';
})->middleware('auth');

// Mostrar los proyectos asignados al usuario.
Route::get('/main.php', [MainController::class, 'index'])
    ->middleware('auth')
    ->name('simep.main');

Route::get('/proyectoTest.php', [ProyectoController::class, 'mostrar'])
    ->middleware('auth')
    ->name('simep.proyecto');

Route::get('/informesCargados.php', [ProyectoController::class, 'mostrarInformes'])
    ->middleware('auth')
    ->name('simep.informes');    