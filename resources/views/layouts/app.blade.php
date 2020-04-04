@include('layouts.timeLocale')
<!DOCTYPE html>
<html lang="es">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo_pagina')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav mx-auto">
            <a class="nav-item nav-link" href="{{ url('/') }}">Inicio <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="{{ route('clientes.index') }}">Clientes</a>
            <a class="nav-item nav-link" href="{{ route('listas.index') }}">Listas</a>
            {{-- <a class="nav-item nav-link" href="{{ route('facturacion.index') }}">Imprimir</a> --}}
          </div>
        </div>
        <span id="FActual" class="navbar-brand"></span>
      </nav>
      <div id="app">
        @yield('content')
      </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>

<script>
  $('#FActual').text(moment().format('LL'))
</script>