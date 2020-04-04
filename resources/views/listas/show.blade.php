@extends('layouts.app')

@section('titulo_pagina')
    Registro - {{$lista->codigo}}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('facturacion.update', ['factura'=>1]) }}">

                </form>
            </div>
        </div>
    </div>
@endsection