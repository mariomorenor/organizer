@include('layouts.timeLocale')
@extends('layouts.app')

@section('titulo_pagina')
    Registros - Inicio
@endsection

@section('content')
<div id="lista">
    <div class="container">
        <div class="row mt-4">
                <h1 class="mr-4 my-auto">Listado de Reses</h1>
        </div>
        <div class="row mt-3">
            <div class="col-3">
                <label for="fecha_Especifica" class="font-weight-bolder">Buscar por Fecha Específica:</label>
                <input id="fecha_Especifica" class="f"  value="1" name="labelFecha" checked type="radio">
            </div>
            <div class="col-3">
                <label for="rangoFecha" class="font-weight-bold">Buscar por Rango de Fechas:</label>
                <input id="rangoFecha" class="f"  value="2" name="labelFecha" type="radio">
            </div>
            <div class="col-6">

            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div id="datepicker"></div>
            </div>
            <div class="col-3 m-0">
                <div class=""  style="height: 18rem">
                    <div class="form-group">
                        <label for="desde" class="font-weight-bold">Desde:</label>
                        <input type="text" class="form-control fechas" id="fechaInicio">
                    </div>
                    <div class="form-group">
                        <label for="hasta" class="font-weight-bold">Hasta:</label>
                        <input type="text" class="form-control fechas" id="fechaFin">
                    </div>
                    <div class="form-group">
                        <button disabled type="button" onclick="buscarPorFechas()" class="btn-block btn btn-success" id="btnbuscar">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div style="margin-top: -60px">
                    <div id="toolbar">
                        <button type="button" onclick="eliminar_Registros(true)" class="btn-danger btn">Eliminar Lista</button>
                        <a class="btn btn-primary" role="button" href="{{ route('listas.create') }}">Agregar Lista</a>
                    </div>
                    <table id="table"  data-unique-id="cliente_codigo" data-custom-search="buscarCodigo" data-show-footer="true" data-url="{{ route('codigos') }}" data-toolbar="#toolbar" data-search="true" data-height="450" class="table" data-locale="es_SP">
                        <thead class="thead-dark">
                            <tr>
                                <th data-field="acciones" data-align="center" data-formatter="accionesFormatter"></th>
                                <th data-field="cliente_codigo" data-align="center" data-footer-formatter="codigoFootterFormatter">Código</th>
                                <th data-field="cantidad" data-align="center" data-footer-formatter="cantidadFooterFoormatter">Cantidad</th>
                                <th data-field="fecha" data-formatter="fechaFormatter" data-align="center" data-footer-formatter="fechaFooterFormatter">Fecha</th>
                                <th data-field="descripcion">Observación</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalActualizar_Registro">
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">Actualizar Registro</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <label class="mb-4 font-weight-bold">Código:</label>
                            <label class="mb-4 font-weight-bold">Cantidad:</label>
                            <label class="mb-4 font-weight-bold">Descripción:</label>
                            <label class="font-weight-bold">Fecha:</label>
                        </div>
                        <div class="col-3">
                            <form id="formActualizar_Registro" method="POST">
                                @csrf
                                @method('PUT')
                                <label class="font-weight-bold mb-3" id="codigo_actualizar"></label>
                                <input type="number" name="cantidad" id="input_cantidad_actualizar" min="1" value="1" class="form-control mb-3" required>
                                <input type="text" name="descripcion" id="input_descripcion_actualizar" style="width: 15rem" class="form-control mb-3" >
                                <input type="text" name="fecha" style="width: 8rem" id="input_fecha_actualizar" class="form-control" readonly>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <button type="button" onclick="actualizarRegistro(document.getElementById('codigo_actualizar').innerHTML)" class="btn btn-success">Guardar Cambios</button>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
    <script src="{{ asset('js/listasIndex.js') }}"></script>
@endsection