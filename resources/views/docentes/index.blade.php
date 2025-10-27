@extends('layouts.app')

@section('content')
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold">Docentes</h1>
    <a href="{{ route('web.docentes.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Nuevo</a>
  </div>

  <div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full">
      <thead class="bg-gray-50">
        <tr class="text-left">
          <th class="p-3">CI</th>
          <th class="p-3">Nombre</th>
          <th class="p-3">Email</th>
          <th class="p-3">Teléfono</th>
          <th class="p-3">Categoría</th>
          <th class="p-3">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($docentes as $d)
          <tr class="border-t">
            <td class="p-3">{{ $d->ci }}</td>
            <td class="p-3">{{ $d->nombre }}</td>
            <td class="p-3">{{ $d->email }}</td>
            <td class="p-3">{{ $d->telefono }}</td>
            <td class="p-3">{{ $d->categoria }}</td>
            <td class="p-3 flex gap-2">
              <a class="px-3 py-1 rounded bg-yellow-500 text-white" href="{{ route('web.docentes.edit',$d) }}">Editar</a>
              <form method="POST" action="{{ route('web.docentes.destroy',$d) }}" onsubmit="return confirm('¿Eliminar docente?')">
                @csrf @method('DELETE')
                <button class="px-3 py-1 rounded bg-red-600 text-white">Eliminar</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="p-3 text-center text-gray-500">Sin registros</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $docentes->links() }}
  </div>
@endsection
