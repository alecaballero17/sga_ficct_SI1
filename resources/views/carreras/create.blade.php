@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Nueva Carrera</h1>

  <form method="POST" action="{{ route('web.carreras.store') }}" class="bg-white p-4 rounded shadow max-w-lg">
    @csrf

    <div class="mb-3">
      <label class="block mb-1 text-sm font-medium">Código</label>
      <input name="codigo" value="{{ old('codigo') }}" class="w-full border rounded px-3 py-2" required>
      @error('codigo') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-3">
      <label class="block mb-1 text-sm font-medium">Nombre</label>
      <input name="nombre" value="{{ old('nombre') }}" class="w-full border rounded px-3 py-2" required>
      @error('nombre') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-3">
      <label class="block mb-1 text-sm font-medium">Facultad</label>
      <select name="facultad_id" class="w-full border rounded px-3 py-2" required>
        <option value="">Seleccione una facultad</option>
        @foreach($facultades as $fac)
          <option value="{{ $fac->id }}">{{ $fac->nombre }}</option>
        @endforeach
      </select>
      @error('facultad_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">Guardar</button>
    <a href="{{ route('web.carreras.index') }}" class="px-4 py-2 bg-gray-300 rounded">Cancelar</a>
  </form>
@endsection
