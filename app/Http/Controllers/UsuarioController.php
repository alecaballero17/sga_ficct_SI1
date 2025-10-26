<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Mostrar todos los usuarios con su rol
     */
    public function index()
    {
        return User::with('role')->orderByDesc('id')->get();
    }

    /**
     * Crear un nuevo usuario
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'nullable|exists:roles,id'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json($user->load('role'), 201);
    }

    /**
     * Mostrar un usuario específico
     */
    public function show(User $usuario)
    {
        return $usuario->load('role');
    }

    /**
     * Actualizar un usuario
     */
    public function update(Request $request, User $usuario)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:100',
            'email' => "sometimes|email|unique:users,email,{$usuario->id}",
            'password' => 'nullable|string|min:6',
            'role_id' => 'nullable|exists:roles,id'
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $usuario->update($data);

        return $usuario->load('role');
    }

    /**
     * Eliminar un usuario
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return response()->json(['ok' => true]);
    }
}
