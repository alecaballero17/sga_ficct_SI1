<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function index() { return Aula::orderBy('codigo')->get(); }

    public function store(Request $r) {
        $data = $r->validate([
            'codigo'=>'required|string|max:20|unique:aulas,codigo',
            'capacidad'=>'integer|min:1',
            'ubicacion'=>'nullable|string|max:120',
        ]);
        $data['capacidad'] = $data['capacidad'] ?? 40;
        return response()->json(Aula::create($data), 201);
    }

    public function show(Aula $aula) { return $aula->load('grupos'); }

    public function update(Request $r, Aula $aula) {
        $data = $r->validate([
            'codigo'=>"sometimes|string|max:20|unique:aulas,codigo,{$aula->id}",
            'capacidad'=>'sometimes|integer|min:1',
            'ubicacion'=>'sometimes|nullable|string|max:120',
        ]);
        $aula->update($data);
        return $aula;
    }

    public function destroy(Aula $aula) {
        $aula->delete();
        return response()->json(['ok'=>true]);
    }
}
