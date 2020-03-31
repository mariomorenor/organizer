@extends('layouts.app')

@section('titulo_pagina')
    Clientes - Modificar Cliente
@endsection

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-7 mx-auto">
            <form class="bg-white rounded p-4 shadow" method="POST" action="{{ route('clientes.update',['cliente'=>$cliente->codigo]) }}">
                @csrf
                @method('PUT')
                <div class="d-flex">
                    <h1 class="font-weight-bold">Nuevo Cliente</h1>
                    <div class="m-auto">
                        <label for="mostrar" class="font-weight-bold">Mostrar en Lista</label>
                        <input type="checkbox" value="false" name="0" hidden>
                        <input type="checkbox" id="mostrar" value="1" @if($cliente->mostrar) checked @endif name="mostrar">
                    </div>
                    <div class="ml-auto mr-5">
                        <a class="btn btn-info" role="button" href="{{ route('clientes.index')}}">Regresar</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="codigo">Código:</label>
                            <input readonly value="{{$cliente->codigo}}" type="text" name="codigo" required id="codigo" class="form-control @error('codigo') is-invalid @enderror">
                            @error('codigo')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="nombre">Nombres:</label>
                            <input value="{{$cliente->nombre}}" type="text" name="nombre" id="nombre" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="cedula">Cédula:</label>
                            <input value="{{$cliente->cedula}}" type="text" name="cedula" id="cedula" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input value="{{$cliente->telefono}}" type="text" name="telefono" id="telefono" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input value="{{$cliente->direccion}}" type="text" name="direccion" id="direccion" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="posicion">Posicion:</label>
                            <input value="{{$cliente->posicion}}" type="text" name="posicion" placeholder="Código que va Antes" id="posicion" class="form-control @error('posicion') is-invalid @enderror">
                            @error('posicion')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-8 mx-auto">
                        <button type="submit" class="btn btn-block btn-success shadow">ACTUALIZAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @if (session('status'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Registro Actualizado Correctamente',
            timer: 1400
        })
       
    </script>
    @endif
@endsection