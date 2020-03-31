@extends('layouts.app')

@section('titulo_pagina')
    Clientes - Inicio
@endsection

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-10 mx-auto">
                <h1>Listado de Clientes</h1>
                <div id="toolbar">
                    <button id="remove" class="btn btn-danger" disabled>Eliminar</button>
                    <a class="btn btn-success ml-5" href="{{ route('clientes.create') }}">Agregar</a>
                </div>
              <table class="table table-borderless table-striped" id="table" data-locale="es_SP" data-url="{{ route('clientes.index')}}" data-height="450" data-toolbar="#toolbar" data-search="true"  data-custom-search="customSearch">
                <thead class="bg-primary text-light">
                    <tr>
                        <th data-field="state" data-width="77" data-formatter="operateFormatter" data-checkbox="true"></th>
                        <th data-field="codigo">Código</th>
                        <th data-field="nombre">Nombres</th>
                        <th data-field="cedula">Cédula</th>
                        <th data-field="telefono">Teléfono</th>
                        <th data-field="direccion">Dirección</th>
                    </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/clientes.js') }}"></script>
@endsection
