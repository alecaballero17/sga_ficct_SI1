<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SGA FICCT</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
  <nav class="bg-white shadow mb-6">
    <div class="mx-auto max-w-6xl px-4 py-3 flex gap-4">
      <a href="{{ url('/') }}" class="font-semibold">SGA FICCT</a>
      <a href="{{ route('web.docentes.index') }}" class="hover:underline">Docentes</a>
      <a href="{{ route('web.facultades.index') }}" class="hover:underline">Facultades</a>
      <a href="{{ route('web.carreras.index') }}" class="hover:underline">Carreras</a>
      <a href="{{ route('web.materias.index') }}" class="hover:underline">Materias</a>
      <a href="{{ route('web.aulas.index') }}" class="hover:underline">Aulas</a>
    </div>
  </nav>

  <main class="mx-auto max-w-6xl px-4">
    @if(session('ok'))
      <div class="mb-4 rounded bg-green-100 text-green-800 px-4 py-2">
        {{ session('ok') }}
      </div>
    @endif
    @yield('content')
  </main>
</body>
</html>
