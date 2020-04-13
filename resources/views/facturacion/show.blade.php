@extends('layouts.app')

@section('titulo_pagina')
    Pagos - {{$codigo}}
@endsection

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-8 mx-auto">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="codigo" class="font-weight-bold">Código:</label>
                                    <div class="d-flex">
                                        <input type="text" readonly value="{{$codigo}}" id="codigo" class="form-control text-center">
                                        <label for="filtro" class="font-weight-bold ml-2 my-auto mr-2">Ver:</label>
                                        <select onchange="buscar_por_Filtro(this.value)" name="filtro" id="filtro" class="form-control">
                                            <option value="all">Todo</option>
                                            <option value="pagado">Pagado</option>
                                            <option value="pelado de patas">Pelado de Patas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('pagos.index') }}" class="btn btn-secondary">Regresar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table" data-locale="es_SP"  >
                            <thead class="bg-success">
                                <tr>
                                    <th data-field="tipo_transaccion">Tipo Transacción</th>
                                    <th data-sortable="true" data-field="fecha">Fecha</th>
                                    <th data-sortable="true" data-align="center" data-field="reses">Reses</th>
                                    <th data-align="center" data-field="cantidad">Cantidad $</th>
                                    <th data-align="center" data-field="saldo">Saldo</th>
                                    <th data-field="descripcion">Descripción</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/facturacionShow.js') }}"></script>
@endsection