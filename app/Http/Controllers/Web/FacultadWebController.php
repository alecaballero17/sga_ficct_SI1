<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Facultad;
use Illuminate\Http\Request;

class FacultadWebController extends Controller
{
    public function index()
    {
        $facultades = Facultad::orderBy('id','desc')->paginate(10);
        return view('facultades.index', compact('facultades'));
    }

    public function create()
    {
        return view('facultades.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'nombre' => 'required|string|max:120',
            'sigla'  => 'nullable|string|max:20',
        ]);
        Facultad::create($data);
        return redirect()->route('web.facultades.index')->with('ok', 'Facultad creada');
    }

    public function edit(Facultad $facultad)
    {
        return view('facultades.edit', compact('facultad'));
    }

    public function update(Request $r, Facultad $facultad)
    {
        $data = $r->validate([
            'nombre' => 'required|string|max:120',
            'sigla'  => 'nullable|string|max:20',
        ]);
        $facultad->update($data);
        return redirect()->route('web.facultades.index')->with('ok', 'Facultad actualizada');
    }

    public function destroy(Facultad $facultad)
    {
        $facultad->delete();
        return redirect()->route('web.facultades.index')->with('ok', 'Facultad eliminada');
    }
}
