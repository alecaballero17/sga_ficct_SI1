<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleController;

// RUTA DE PRUEBA
Route::get('/test', function () {
    return response()->json(['ok' => true, 'message' => 'API funcionando']);
});

// AUTENTICACIÓN (SANCTUM)
Route::post('/login', [LoginController::class, 'login']);

// PROTEGIDAS CON TOKEN (solo usuarios autenticados)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [LoginController::class, 'me']);
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::apiResource('roles', RoleController::class);
    Route::apiResource('usuarios', UsuarioController::class);
});
