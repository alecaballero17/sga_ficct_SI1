@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Editar Aula</h1>

  <form class="bg-white shadow rounded p-4 max-w-xl" method="POST" action="{{ route('web.aulas.update',$item) }}">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="block text-sm mb-1">Nombre</label>
      <input name="nombre" class="w-full border rounded px-3 py-2" value="{{ old('nombre',$item->nombre) }}" required>
      @error('nombre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="flex gap-2">
      <button class="px-4 py-2 bg-blue-600 text-white rounded">Actualizar</button>
      <a class="px-4 py-2 bg-gray-200 rounded" href="{{ route('web.aulas.index') }}">Cancelar</a>
    </div>
  </form>
@endsection
