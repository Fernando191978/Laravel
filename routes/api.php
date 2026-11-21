<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProyectoApiController;

Route::get('/proyectos', [ProyectoApiController::class, 'index']);