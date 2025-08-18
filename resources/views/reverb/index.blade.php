@extends('layouts.app')

@section('titulo_pagina', 'TIEMPO REAL REVERB')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">TIEMPO REAL REVERB</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">TIEMPO REAL REVERB</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-secondary" href="{{ route('home') }}">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body" >
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body pt-1">
                        <div class="alert alert-info" role="alert">
                            <strong>Información:</strong> Esta es una vista de prueba para el sistema de reverb.

                            <div class="btn btn-primary mt-4" onclick="fetch('{{ route('test.reverb') }}', { method: 'POST', headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' }})">
                                PRUEBA DE REVERB
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            console.log('Iniciando Reverb...');
            Echo.channel('channel-test')
            .listen('TestEvent', (event) => {
                console.log(event);
            }).error((error) => {
                console.error(error);
            });

            Echo.join('users')
            .here((event) => {
                console.log(event);
            })
            .error((error) => {
                console.error(error);
            });
        })
    </script>
@endpush
