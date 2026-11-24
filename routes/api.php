<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProyectoApiController;
use App\Http\Controllers\AuthController; //Para usar API

Route::get('/proyectos', [ProyectoApiController::class, 'index']);
