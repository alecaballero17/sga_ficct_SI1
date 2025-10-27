<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index() { return Materia::with('carrera')->orderByDesc('id')->get(); }

    public function store(Request $r) {
        $data = $r->validate([
            'nombre'=>'required|string|max:120',
            'codigo'=>'required|string|max:20|unique:materias,codigo',
            'creditos'=>'integer|min:1',
            'carrera_id'=>'required|exists:carreras,id',
        ]);
        $data['creditos'] = $data['creditos'] ?? 3;
        return response()->json(Materia::create($data)->load('carrera'), 201);
    }

    public function show(Materia $materia) { return $materia->load('carrera','grupos'); }

    public function update(Request $r, Materia $materia) {
        $data = $r->validate([
            'nombre'=>'sometimes|string|max:120',
            'codigo'=>"sometimes|string|max:20|unique:materias,codigo,{$materia->id}",
            'creditos'=>'sometimes|integer|min:1',
            'carrera_id'=>'sometimes|exists:carreras,id',
        ]);
        $materia->update($data);
        return $materia->load('carrera');
    }

    public function destroy(Materia $materia) {
        $materia->delete();
        return response()->json(['ok'=>true]);
    }
}
