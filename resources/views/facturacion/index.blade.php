@extends('layouts.app')

@section('titulo_pagina')
    Facturación
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div>
                    <table id="table" class="table">
                        <thead class="bg-success text-dark">
                            <tr>
                                <th data-field="codigo" data-align="center" >Código</th>
                                <th data-field="tipo_transaccion" data-align="center">Última Transacción</th>
                                <th data-field="fecha" data-align="center" >Fecha</th>
                                <th data-field="saldo" data-align="center" >Saldo Actual</th>
                                <th data-field="acciones" data-formatter="accionesFormatter" data-align="center">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
    <script src="{{ asset('js/facturacionIndex.js') }}"></script>
@endsection