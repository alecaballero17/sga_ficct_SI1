<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Web\DocenteWebController;

// Ruta principal (inicio)
Route::get('/', function () {
    return view('inicio');
});

// Ruta de prueba de conexión a BD
Route::get('/test-db', function () {
    try {
        $result = DB::select('select version()');
        return response()->json(['ok' => true, 'version' => $result]);
    } catch (\Throwable $e) {
        return response()->json(['ok' => false, 'error' => $e->getMessage()]);
    }
});

// --------------------------------------------------
// 🔹 RUTAS WEB DEL PANEL ADMINISTRATIVO
// --------------------------------------------------

Route::prefix('admin')->name('web.')->group(function () {
    Route::get('docentes',            [DocenteWebController::class, 'index'])->name('docentes.index');
    Route::get('docentes/crear',      [DocenteWebController::class, 'create'])->name('docentes.create');
    Route::post('docentes',           [DocenteWebController::class, 'store'])->name('docentes.store');
    Route::get('docentes/{docente}/editar', [DocenteWebController::class, 'edit'])->name('docentes.edit');
    Route::put('docentes/{docente}',  [DocenteWebController::class, 'update'])->name('docentes.update');
    Route::delete('docentes/{docente}', [DocenteWebController::class, 'destroy'])->name('docentes.destroy');
});
