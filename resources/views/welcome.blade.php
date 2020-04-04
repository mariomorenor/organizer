
@extends('layouts.app')

@section('titulo_pagina')
    Bienvenido
@endsection

@section('content')
    <div class="container">
        <div class="row mt-5 mx-auto">
            <div class="col-4   justify-content-center d-flex">
                <div>

                    <a href="{{ route('clientes.index') }}">
                        <img id="imgClientes" class="welcomeImages" src="{{ asset('images/imgClientes.png') }}" alt="Clientes">
                    </a>
                </div>
            </div>
            <div class="col-4 justify-content-center d-flex">
                <div class="">
                    <a href="{{ route('listas.index') }}">
                        <img class="welcomeImages" src="{{ asset('images/imgListas.png') }}" alt="Listas">
                    </a>
                </div>
            </div>
            <div class="col-4  justify-content-center d-flex">
                <div class="">
                    <a href="{{ route('pagos.index') }}">
                        <img class="welcomeImages" src="{{ asset('images/imgImprimir.png') }}" alt="Imprimir">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection