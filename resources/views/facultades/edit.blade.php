@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold mb-4">Editar Facultad</h1>

  <form class="bg-white shadow rounded p-4 max-w-xl" method="POST" action="{{ route('web.facultades.update',$facultad) }}">
    @csrf @method('PUT')

    <div class="mb-3">
      <label class="block text-sm mb-1">Nombre</label>
      <input name="nombre" class="w-full border rounded px-3 py-2" value="{{ old('nombre',$facultad->nombre) }}" required>
      @error('nombre') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div class="mb-4">
      <label class="block text-sm mb-1">Sigla</label>
      <input name="sigla" class="w-full border rounded px-3 py-2" value="{{ old('sigla',$facultad->sigla) }}">
    </div>

    <div class="flex gap-2">
      <button class="px-4 py-2 bg-blue-600 text-white rounded">Actualizar</button>
      <a class="px-4 py-2 bg-gray-200 rounded" href="{{ route('web.facultades.index') }}">Cancelar</a>
    </div>
  </form>
@endsection
