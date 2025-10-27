<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --- Controladores de autenticación y seguridad ---
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;

// --- Controladores académicos (PUD1) ---
use App\Http\Controllers\FacultadController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\DocenteController;


// Ruta de prueba para verificar conexión
Route::get('/test', function () {
    return response()->json(['ok' => true, 'message' => 'API funcionando']);
});

// --- Autenticación con Sanctum ---
Route::post('/login', [LoginController::class, 'login']);

// --- Rutas protegidas (solo con token válido) ---
Route::middleware('auth:sanctum')->group(function () {
    // Datos del usuario autenticado
    Route::get('/me', [LoginController::class, 'me']);
    Route::post('/logout', [LoginController::class, 'logout']);

    // UC2 y UC3: Roles y usuarios
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('usuarios', UsuarioController::class);

    // PUD1: estructura académica
    Route::apiResource('facultades', FacultadController::class);
    Route::apiResource('carreras', CarreraController::class);
    Route::apiResource('materias', MateriaController::class);
    Route::apiResource('aulas', AulaController::class);
    Route::apiResource('grupos', GrupoController::class);


    Route::apiResource('docentes', DocenteController::class);

});
