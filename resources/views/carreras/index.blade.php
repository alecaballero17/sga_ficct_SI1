@extends('layouts.app')

@section('content')
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Carreras</h1>
    <a href="{{ route('web.carreras.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Nuevo</a>
  </div>

  <div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full">
      <thead class="bg-gray-50">
        <tr class="text-left">
          <th class="p-3">ID</th>
          <th class="p-3">Código</th>
          <th class="p-3">Nombre</th>
          <th class="p-3">Facultad</th>
          <th class="p-3">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($carreras as $c)
          <tr class="border-t">
            <td class="p-3">{{ $c->id }}</td>
            <td class="p-3">{{ $c->codigo }}</td>
            <td class="p-3">{{ $c->nombre }}</td>
            <td class="p-3">{{ $c->facultad?->nombre ?? '—' }}</td>
            <td class="p-3 flex gap-2">
              <a href="{{ route('web.carreras.edit', $c) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Editar</a>
              <form method="POST" action="{{ route('web.carreras.destroy', $c) }}" onsubmit="return confirm('¿Eliminar carrera?')">
                @csrf @method('DELETE')
                <button class="px-3 py-1 bg-red-600 text-white rounded">Eliminar</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" class="p-3 text-center text-gray-500">Sin registros</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $carreras->links() }}
  </div>
@endsection
