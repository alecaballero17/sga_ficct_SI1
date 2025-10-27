@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Nuevo Docente</h1>

  <form class="bg-white shadow rounded p-4 max-w-xl" method="POST" action="{{ route('web.docentes.store') }}">
    @csrf

    <div class="mb-3">
      <label class="block text-sm mb-1">CI</label>
      <input name="ci" class="w-full border rounded px-3 py-2" required>
      @error('ci') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-3">
      <label class="block text-sm mb-1">Nombre</label>
      <input name="nombre" class="w-full border rounded px-3 py-2" required>
      @error('nombre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-3">
      <label class="block text-sm mb-1">Email</label>
      <input name="email" type="email" class="w-full border rounded px-3 py-2" required>
      @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-3">
      <label class="block text-sm mb-1">Teléfono</label>
      <input name="telefono" class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
      <label class="block text-sm mb-1">Categoría</label>
      <input name="categoria" class="w-full border rounded px-3 py-2" placeholder="Auxiliar, Asistente, etc.">
    </div>

    <div class="flex gap-2">
      <button class="px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
      <a class="px-4 py-2 bg-gray-200 rounded" href="{{ route('web.docentes.index') }}">Cancelar</a>
    </div>
  </form>
@endsection
