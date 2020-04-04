@extends('layouts.app')

@section('titulo_pagina')
    Registros - Crear Lista
@endsection

@section('content')
<div id="listaCreate">
    <div class="container">
        <div class="row mt-3">
            <div class="col-8 mx-auto">
                <div id="toolbar" class="d-flex">
                    <h1>Nueva Lista</h1>
                    <div class="d-flex my-auto ml-5">
                        <input type="text" class="form-control" placeholder="Código" id="codigo_a_insertar"
                            name="codigo_a_insertar">
                        <div>
                            <button type="button"  onclick="insertar_Registro();"
                                class="btn btn-primary ml-3">Insertar</button>
                            
                        </div>
                        <h5 id="TituloFecha" class="ml-1"></h5>
                    </div>
                </div>
                <form id="formAgregar_Lista" method="POST" action="{{ route('listas.store') }}">
                    @csrf
                <table id="table" data-height="500"  data-toolbar="#toolbar"
                    class="table" data-locale="es_SP">
                    <thead class="thead-dark">
                        <tr>
                            <th data-field="accion" data-formatter="accionesFormatter"><button
                                    onclick="eliminar_Registros(true)" type="button" title="Eliminar Todo"
                                    class="btn btn-danger btn-sm"><svg class="bi bi-trash-fill" width="1em" height="1em"
                                        viewBox="0 0 16 16" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M2.5 1a1 1 0 00-1 1v1a1 1 0 001 1H3v9a2 2 0 002 2h6a2 2 0 002-2V4h.5a1 1 0 001-1V2a1 1 0 00-1-1H10a1 1 0 00-1-1H7a1 1 0 00-1 1H2.5zm3 4a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7a.5.5 0 01.5-.5zM8 5a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7A.5.5 0 018 5zm3 .5a.5.5 0 00-1 0v7a.5.5 0 001 0v-7z"
                                            clip-rule="evenodd"/>
                                    </svg></button></th>
                            <th data-field="codigo" data-formatter="codigoFormatter" data-width="130" data-align="center">Código</th>
                            <th data-field="cantidad" data-width="100" data-formatter="cantidadFormatter">Cantidad</th>
                            <th data-field="fecha" data-width="200" data-align="center" data-formatter="fechaFormatter">
                                Fecha</th>
                            <th data-field="observacion" data-formatter="observacionFormatter">Observación</th>
                        </tr>
                    </thead>
                </table>
                <input type="text" hidden id="fecha" name="fecha">
            </form>
            </div>
            <div class="col-4 mt-3">
                <div id="datepicker"></div>
                {{-- <input id="datepicker"> --}}
                <div class="card mt-4 shadow">
                    <div class="card-body">
                        <h2 class="font-weight-bold">Total de Reses: <label id="labelTotalReses"
                                class="ml-2 text-primary"></label></h2>
                        <div class="form-group">
                            <button onclick="enviarFormulario()" class="btn btn-block btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/listasCreate.js') }}"></script>
    @isset($codigos_existentes)
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Verifique los Códigos!',
                text: 'Existen Códigos que ya están guardados en la Fecha que intenta ingresar'
            })
        </script>
    @else 
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Seleccione la Fecha antes de Empezar a Guardar la Lista',
                timer: '2000'
            })
        </script>
    @endisset

@endsection