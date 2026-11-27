<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\AvanceController;
use App\Http\Controllers\IndicadorController;
use App\Http\Controllers\ActividadController;

// Mostrar y procesar el formulario de inicio de sesión.
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Cerrar sesión.
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('indicadores.index')
        : redirect()->route('login');
});
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
    
// --- RUTAS DE AVANCES (Agregar al final) ---
Route::middleware('auth')->group(function () {
    Route::get('/proyecto/{id}/avances', [AvanceController::class, 'index'])->name('avances.index');

    Route::get('/proyecto/{id}/avances/cargar', [AvanceController::class, 'create'])->name('avances.create');

    Route::post('/proyecto/{id}/avances', [AvanceController::class, 'store'])->name('avances.store');
    
    Route::delete('/avance/{id}/eliminar', [AvanceController::class, 'destroy'])->name('avances.destroy');
}); 

// Rutas para indicadores y actividades
Route::middleware('auth')->group(function () {

    Route::get('/proyecto/{id}/actividades', [ActividadController::class, 'index'])
        ->name('actividades.index');

    Route::get('/proyecto/{id}/actividades/crear', [ActividadController::class, 'create'])
        ->name('actividades.create');

    Route::post('/proyecto/{id}/actividades', [ActividadController::class, 'store'])
        ->name('actividades.store');

});

Route::get('/indicadores', [IndicadorController::class, 'index'])
    ->name('indicadores.index');