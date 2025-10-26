<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::orderByDesc('id')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50|unique:roles,nombre',
            'estado' => 'boolean'
        ]);

        return response()->json(Role::create($data), 201);
    }

    public function show(Role $role)
    {
        return $role;
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|string|max:50|unique:roles,nombre,' . $role->id,
            'estado' => 'sometimes|boolean'
        ]);

        $role->update($data);
        return $role;
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['ok' => true]);
    }
}
