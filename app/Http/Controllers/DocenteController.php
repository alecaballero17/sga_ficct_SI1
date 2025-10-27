<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        return Docente::orderBy('nombre')->get();
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'ci'        => 'required|string|max:20|unique:docentes,ci',
            'nombre'    => 'required|string|max:120',
            'email'     => 'required|email|max:120|unique:docentes,email',
            'telefono'  => 'nullable|string|max:30',
            'categoria' => 'nullable|string|max:50',
        ]);
        return response()->json(Docente::create($data), 201);
    }

    public function show(Docente $docente)
    {
        return $docente;
    }

    public function update(Request $r, Docente $docente)
    {
        $data = $r->validate([
            'ci'        => "sometimes|string|max:20|unique:docentes,ci,{$docente->id}",
            'nombre'    => 'sometimes|string|max:120',
            'email'     => "sometimes|email|max:120|unique:docentes,email,{$docente->id}",
            'telefono'  => 'sometimes|nullable|string|max:30',
            'categoria' => 'sometimes|nullable|string|max:50',
        ]);
        $docente->update($data);
        return $docente;
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();
        return response()->json(['ok' => true]);
    }
}
