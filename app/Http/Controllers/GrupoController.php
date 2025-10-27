<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index() { return Grupo::with(['materia','aula'])->orderByDesc('id')->get(); }

    public function store(Request $r) {
        $data = $r->validate([
            'codigo'=>'required|string|max:10',
            'materia_id'=>'required|exists:materias,id',
            'aula_id'=>'nullable|exists:aulas,id',
            'cupos'=>'integer|min:1',
        ]);
        $data['cupos'] = $data['cupos'] ?? 30;
        return response()->json(Grupo::create($data)->load(['materia','aula']), 201);
    }

    public function show(Grupo $grupo) { return $grupo->load(['materia','aula']); }

    public function update(Request $r, Grupo $grupo) {
        $data = $r->validate([
            'codigo'=>'sometimes|string|max:10',
            'materia_id'=>'sometimes|exists:materias,id',
            'aula_id'=>'sometimes|nullable|exists:aulas,id',
            'cupos'=>'sometimes|integer|min:1',
        ]);
        $grupo->update($data);
        return $grupo->load(['materia','aula']);
    }

    public function destroy(Grupo $grupo) {
        $grupo->delete();
        return response()->json(['ok'=>true]);
    }
}
