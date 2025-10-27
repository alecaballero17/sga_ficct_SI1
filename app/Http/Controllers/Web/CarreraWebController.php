<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraWebController extends Controller
{
    public function index()
    {
        $carreras = Carrera::orderBy('id','desc')->paginate(10);
        return view('carreras.index', compact('carreras'));
    }

    public function create()
    {
        return view('carreras.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'nombre' => 'required|string|max:120',
        ]);
        Carrera::create($data);
        return redirect()->route('web.carreras.index')->with('ok', 'Carrera creada');
    }

    public function edit(Carrera $carrera)
    {
        return view('carreras.edit', ['item' => $carrera]);
    }

    public function update(Request $r, Carrera $carrera)
    {
        $data = $r->validate([
            'nombre' => 'required|string|max:120',
        ]);
        $carrera->update($data);
        return redirect()->route('web.carreras.index')->with('ok', 'Carrera actualizada');
    }

    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return redirect()->route('web.carreras.index')->with('ok', 'Carrera eliminada');
    }
}
