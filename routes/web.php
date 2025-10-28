<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// WebControllers (panel)
use App\Http\Controllers\Web\DocenteWebController;
use App\Http\Controllers\Web\FacultadWebController;
use App\Http\Controllers\Web\CarreraWebController;
use App\Http\Controllers\Web\MateriaWebController;
use App\Http\Controllers\Web\AulaWebController;

/*
|--------------------------------------------------------------------------
| Página de inicio
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // Si estás usando Breeze, puedes redirigir al dashboard
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('inicio'); // o return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Prueba de conexión a BD
|--------------------------------------------------------------------------
*/
Route::get('/test-db', function () {
    try {
        $result = DB::select('select version()');
        return response()->json(['ok' => true, 'version' => $result]);
    } catch (\Throwable $e) {
        return response()->json(['ok' => false, 'error' => $e->getMessage()]);
    }
});

/*
|--------------------------------------------------------------------------
| Dashboard protegido (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Panel administrativo (Blade) - PROTEGIDO
| URL base: /admin/...
| Solo roles: Admin y Coordinador
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->as('web.')
    ->middleware(['auth', 'rol:Admin,Coordinador'])
    ->group(function () {

        // Docentes
        Route::get('docentes',                     [DocenteWebController::class, 'index'])->name('docentes.index');
        Route::get('docentes/crear',               [DocenteWebController::class, 'create'])->name('docentes.create');
        Route::post('docentes',                    [DocenteWebController::class, 'store'])->name('docentes.store');
        Route::get('docentes/{docente}/editar',    [DocenteWebController::class, 'edit'])->name('docentes.edit');
        Route::put('docentes/{docente}',           [DocenteWebController::class, 'update'])->name('docentes.update');
        Route::delete('docentes/{docente}',        [DocenteWebController::class, 'destroy'])->name('docentes.destroy');

        // Facultades
        Route::get('facultades',                   [FacultadWebController::class, 'index'])->name('facultades.index');
        Route::get('facultades/crear',             [FacultadWebController::class, 'create'])->name('facultades.create');
        Route::post('facultades',                  [FacultadWebController::class, 'store'])->name('facultades.store');
        Route::get('facultades/{facultad}/editar', [FacultadWebController::class, 'edit'])->name('facultades.edit');
        Route::put('facultades/{facultad}',        [FacultadWebController::class, 'update'])->name('facultades.update');
        Route::delete('facultades/{facultad}',     [FacultadWebController::class, 'destroy'])->name('facultades.destroy');

        // Carreras
        Route::get('carreras',                     [CarreraWebController::class, 'index'])->name('carreras.index');
        Route::get('carreras/crear',               [CarreraWebController::class, 'create'])->name('carreras.create');
        Route::post('carreras',                    [CarreraWebController::class, 'store'])->name('carreras.store');
        Route::get('carreras/{carrera}/editar',    [CarreraWebController::class, 'edit'])->name('carreras.edit');
        Route::put('carreras/{carrera}',           [CarreraWebController::class, 'update'])->name('carreras.update');
        Route::delete('carreras/{carrera}',        [CarreraWebController::class, 'destroy'])->name('carreras.destroy');

        // Materias
        Route::get('materias',                     [MateriaWebController::class, 'index'])->name('materias.index');
        Route::get('materias/crear',               [MateriaWebController::class, 'create'])->name('materias.create');
        Route::post('materias',                    [MateriaWebController::class, 'store'])->name('materias.store');
        Route::get('materias/{materia}/editar',    [MateriaWebController::class, 'edit'])->name('materias.edit');
        Route::put('materias/{materia}',           [MateriaWebController::class, 'update'])->name('materias.update');
        Route::delete('materias/{materia}',        [MateriaWebController::class, 'destroy'])->name('materias.destroy');

        // Aulas
        Route::get('aulas',                        [AulaWebController::class, 'index'])->name('aulas.index');
        Route::get('aulas/crear',                  [AulaWebController::class, 'create'])->name('aulas.create');
        Route::post('aulas',                       [AulaWebController::class, 'store'])->name('aulas.store');
        Route::get('aulas/{aula}/editar',          [AulaWebController::class, 'edit'])->name('aulas.edit');
        Route::put('aulas/{aula}',                 [AulaWebController::class, 'update'])->name('aulas.update');
        Route::delete('aulas/{aula}',              [AulaWebController::class, 'destroy'])->name('aulas.destroy');
    });

/*
|--------------------------------------------------------------------------
| Rutas de autenticación de Breeze
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
