<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use App\Models\Facultad;
use Illuminate\Http\Request;

class CarreraWebController extends Controller
{
    public function index()
    {
        $carreras = Carrera::with('facultad')
            ->orderBy('nombre')
            ->paginate(10);

        return view('carreras.index', compact('carreras'));
    }

    public function create()
    {
        $facultades = Facultad::orderBy('nombre')->get();
        return view('carreras.create', compact('facultades'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'       => ['required','string','max:100'],
            'sigla'        => ['nullable','string','max:10'],
            'facultad_id'  => ['required','exists:facultad,id'],
            'estado'       => ['nullable','boolean'],
        ]);
        $data['estado'] = (bool) ($data['estado'] ?? true);

        Carrera::create($data);

        return redirect()->route('web.carreras.index')->with('ok', 'Carrera creada correctamente.');
    }

    public function edit(Carrera $carrera)
    {
        $facultades = Facultad::orderBy('nombre')->get();
        return view('carreras.edit', compact('carrera','facultades'));
    }

    public function update(Request $request, Carrera $carrera)
    {
        $data = $request->validate([
            'nombre'       => ['required','string','max:100'],
            'sigla'        => ['nullable','string','max:10'],
            'facultad_id'  => ['required','exists:facultad,id'],
            'estado'       => ['nullable','boolean'],
        ]);
        $data['estado'] = (bool) ($data['estado'] ?? true);

        $carrera->update($data);

        return redirect()->route('web.carreras.index')->with('ok', 'Carrera actualizada correctamente.');
    }

    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return back()->with('ok', 'Carrera eliminada.');
    }
}
