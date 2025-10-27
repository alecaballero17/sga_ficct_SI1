<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Docente;
use Illuminate\Http\Request;

class DocenteWebController extends Controller
{
    public function index()
    {
        $docentes = Docente::orderBy('nombre')->paginate(10);
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('docentes.create');
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
        Docente::create($data);
        return redirect()->route('web.docentes.index')->with('ok', 'Docente creado');
    }

    public function edit(Docente $docente)
    {
        return view('docentes.edit', compact('docente'));
    }

    public function update(Request $r, Docente $docente)
    {
        $data = $r->validate([
            'ci'        => "required|string|max:20|unique:docentes,ci,{$docente->id}",
            'nombre'    => 'required|string|max:120',
            'email'     => "required|email|max:120|unique:docentes,email,{$docente->id}",
            'telefono'  => 'nullable|string|max:30',
            'categoria' => 'nullable|string|max:50',
        ]);
        $docente->update($data);
        return redirect()->route('web.docentes.index')->with('ok', 'Docente actualizado');
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();
        return redirect()->route('web.docentes.index')->with('ok', 'Docente eliminado');
    }
}
