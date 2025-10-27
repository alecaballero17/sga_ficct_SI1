<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaWebController extends Controller
{
    public function index()
    {
        $materias = Materia::orderBy('id','desc')->paginate(10);
        return view('materias.index', compact('materias'));
    }

    public function create()
    {
        return view('materias.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate(['nombre' => 'required|string|max:120']);
        Materia::create($data);
        return redirect()->route('web.materias.index')->with('ok','Materia creada');
    }

    public function edit(Materia $materia)
    {
        return view('materias.edit', ['item' => $materia]);
    }

    public function update(Request $r, Materia $materia)
    {
        $data = $r->validate(['nombre' => 'required|string|max:120']);
        $materia->update($data);
        return redirect()->route('web.materias.index')->with('ok','Materia actualizada');
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('web.materias.index')->with('ok','Materia eliminada');
    }
}
