<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Aula;
use Illuminate\Http\Request;

class AulaWebController extends Controller
{
    public function index()
    {
        $aulas = Aula::orderBy('id','desc')->paginate(10);
        return view('aulas.index', compact('aulas'));
    }

    public function create()
    {
        return view('aulas.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate(['nombre' => 'required|string|max:120']);
        Aula::create($data);
        return redirect()->route('web.aulas.index')->with('ok','Aula creada');
    }

    public function edit(Aula $aula)
    {
        return view('aulas.edit', ['item' => $aula]);
    }

    public function update(Request $r, Aula $aula)
    {
        $data = $r->validate(['nombre' => 'required|string|max:120']);
        $aula->update($data);
        return redirect()->route('web.aulas.index')->with('ok','Aula actualizada');
    }

    public function destroy(Aula $aula)
    {
        $aula->delete();
        return redirect()->route('web.aulas.index')->with('ok','Aula eliminada');
    }
}
