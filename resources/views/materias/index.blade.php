@extends('layouts.app')

@section('content')
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Materias</h1>
    <a href="{{ route('web.materias.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Nuevo</a>
  </div>

  <div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full">
      <thead class="bg-gray-50">
        <tr class="text-left">
          <th class="p-3">ID</th>
          <th class="p-3">Nombre</th>
          <th class="p-3">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($materias as $item)
          <tr class="border-t">
            <td class="p-3">{{ $item->id }}</td>
            <td class="p-3">{{ $item->nombre }}</td>
            <td class="p-3 flex gap-2">
              <a class="px-3 py-1 rounded bg-yellow-500 text-white" href="{{ route('web.materias.edit',$item) }}">Editar</a>
              <form method="POST" action="{{ route('web.materias.destroy',$item) }}" onsubmit="return confirm('¿Eliminar materia?')">
                @csrf @method('DELETE')
                <button class="px-3 py-1 rounded bg-red-600 text-white">Eliminar</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="3" class="p-3 text-center text-gray-500">Sin registros</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $materias->links() }}
  </div>
@endsection
