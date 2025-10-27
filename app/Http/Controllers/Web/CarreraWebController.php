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
        $carreras = \App\Models\Carrera::with('facultad')
            ->orderBy('nombre')
            ->paginate(10); // <— en vez de get()
        return view('carreras.index', compact('carreras'));
    }


    public function create()
    {
        // ✅ Enviar $facultades a la vista
        $facultades = Facultad::orderBy('nombre')->get();
        return view('carreras.create', compact('facultades'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo'      => ['required','string','max:20','unique:carreras,codigo'],
            'nombre'      => ['required','string','max:255'],
            'facultad_id' => ['required','exists:facultads,id'],
        ]);

        Carrera::create($data);

        return redirect()
            ->route('web.carreras.index')
            ->with('ok', 'Carrera creada correctamente.');
    }

    public function edit(Carrera $carrera)
    {
        $facultades = Facultad::orderBy('nombre')->get();
        return view('carreras.edit', compact('carrera','facultades'));
    }

    public function update(Request $request, Carrera $carrera)
    {
        $data = $request->validate([
            'codigo'      => ['required','string','max:20','unique:carreras,codigo,'.$carrera->id],
            'nombre'      => ['required','string','max:255'],
            'facultad_id' => ['required','exists:facultads,id'],
        ]);

        $carrera->update($data);

        return redirect()
            ->route('web.carreras.index')
            ->with('ok', 'Carrera actualizada correctamente.');
    }

    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return back()->with('ok', 'Carrera eliminada.');
    }
}
