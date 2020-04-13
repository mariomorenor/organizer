@extends('layouts.app')

@section('titulo_pagina')
    Generar Pagos
@endsection

@section('content')
<div class="container">
    <div class="row my-4">
        <div class="col">
                <div id="toolbar">
                    <div class="d-inline-flex mr-5">
                        <input type="text" class="form-control"  autocomplete="off" list="codigos" id="codigo_a_insertar" placeholder="Ingrese el Código">
                        <button onclick="insertarCodigo()" type="button" class="btn btn-primary ml-2">Insertar</button>
                    </div>
                    <label class="ml-5 font-weight-bold">PAGAR:</label>
                    <button type="submit"  class="btn btn-success"><i class="fas fa-money-bill-alt fa-2x"></i></button>
                </div>
                <form id="formPagos" method="POST" action="{{ route('pagos.store') }}">
                    @csrf
                <table id="table" >
                    <thead>
                        <tr><th data-field="acciones" data-formatter="accionesFormatter" data-width="100" data-align="center">Acciones</th>
                            <th data-field="codigo" data-formatter="codigoFormatter" data-align="center">Código</th>
                            <th data-field="cantidad" data-width="200" data-formatter="dineroFormatter" data-align="center">Cantidad</th>
                            <th data-field="reses" data-width="200" data-formatter="resesFormatter" data-align="center">Reses</th>
                            <th data-field="saldo">Saldo</th>
                            <th data-field="fecha" data-width="300" data-formatter="fechaFormatter" data-align="center">Fecha</th>
                            <th data-field="descripcion" data-formatter="descripcionFormatter">Descripción</th>
                        </tr>
                    </thead>
                </table>
            </form>
        </div>
    </div>
</div>
<datalist id="codigos">
@isset($listado_codigos)
    @foreach ($listado_codigos as $registros)
        <option value="{{$registros->codigo}}">{{$registros->codigo}}</option>
    @endforeach
@endisset
</datalist>
@endsection

@section('scripts')
    <script src="{{ asset('js/facturacionCreate.js') }}"></script>
@endsection