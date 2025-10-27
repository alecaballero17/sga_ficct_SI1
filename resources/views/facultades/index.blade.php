@extends('layouts.app')

@section('content')
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Facultades</h1>
    <a href="{{ route('web.facultades.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Nuevo</a>
  </div>

  <div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full">
      <thead class="bg-gray-50">
        <tr class="text-left">
          <th class="p-3">ID</th>
          <th class="p-3">Nombre</th>
          <th class="p-3">Sigla</th>
          <th class="p-3">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($facultades as $f)
          <tr class="border-t">
            <td class="p-3">{{ $f->id }}</td>
            <td class="p-3">{{ $f->nombre }}</td>
            <td class="p-3">{{ $f->sigla }}</td>
            <td class="p-3 flex gap-2">
              <a class="px-3 py-1 rounded bg-yellow-500 text-white" href="{{ route('web.facultades.edit',$f) }}">Editar</a>
              <form method="POST" action="{{ route('web.facultades.destroy',$f) }}" onsubmit="return confirm('¿Eliminar?')">
                @csrf @method('DELETE')
                <button class="px-3 py-1 rounded bg-red-600 text-white">Eliminar</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="p-3 text-center text-gray-500">Sin registros</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $facultades->links() }}
  </div>
@endsection
