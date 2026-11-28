<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\AvanceController;
use App\Http\Controllers\IndicadorController;
use App\Http\Controllers\ActividadController;
use Illuminate\Support\Facades\Route;

// Inicio de sesión.
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Cerrar sesión.
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Indicadores: página pública.
Route::get('/', [IndicadorController::class, 'index'])->name('indicadores.index');
Route::get('/indicadores', [IndicadorController::class, 'index']);

// Páginas que requieren iniciar sesión.
Route::middleware('auth')->group(function () {
    Route::get('/main.php', [MainController::class, 'index'])->name('simep.main');

    Route::get('/proyectoTest.php', [ProyectoController::class, 'mostrar'])
        ->name('simep.proyecto');

    Route::get('/informesCargados.php', [ProyectoController::class, 'mostrarInformes'])
        ->name('simep.informes');

    Route::get('/proyecto/{id}/avances', [AvanceController::class, 'index'])
        ->name('avances.index');

    Route::get('/proyecto/{id}/avances/cargar', [AvanceController::class, 'create'])
        ->name('avances.create');

    Route::post('/proyecto/{id}/avances', [AvanceController::class, 'store'])
        ->name('avances.store');

    Route::delete('/avance/{id}/eliminar', [AvanceController::class, 'destroy'])
        ->name('avances.destroy');

    Route::get('/proyecto/{id}/actividades', [ActividadController::class, 'index'])
        ->name('actividades.index');

    Route::get('/proyecto/{id}/actividades/crear', [ActividadController::class, 'create'])
        ->name('actividades.create');

    Route::post('/proyecto/{id}/actividades', [ActividadController::class, 'store'])
        ->name('actividades.store');

    // Nueva ruta para ver TODAS las actividades
    Route::get('/actividades/listaCompletaActividades', [ActividadController::class, 'listaCompletaActividades'])
        ->name('actividades.listaCompletaActividades');
});