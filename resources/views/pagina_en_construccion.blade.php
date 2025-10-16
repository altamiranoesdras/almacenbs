@extends('layouts.app')

@section('titulo_pagina', 'Pagina en construcción')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        Pagina en construcción
                    </h2>
                </div>
            </div>
        </div>

        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-primary float-end"
                       href="{{ route('admin.home') }}">
                        <i class="fa fa-home"></i>
                        Inicio
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

        <div class="row">
            <div class="col-12">
                <div class="card uc-card shadow-sm">
                    <div class="card-body p-4 p-md-5 text-center">
                        <h1 class="uc-title mb-1">Página en construcción</h1>

                        <p class="uc-text mb-3">
                            Estamos trabajando para habilitar este contenido. Agradecemos su comprensión.
                        </p>

                        {{-- Información opcional: fecha estimada y referencia a ticket/notas --}}
                        @isset($eta)
                            <p class="text-muted mb-2">Disponibilidad estimada: <strong>{{ $eta }}</strong></p>
                        @endisset

                        @isset($referenceUrl)
                            <p class="mb-3">
                                <a href="{{ $referenceUrl }}" class="link-primary" target="_blank" rel="noopener">
                                    Ver notas de actualización
                                </a>
                            </p>
                        @endisset

                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="{{ url('/') }}" class="btn btn-primary">
                                <i class="fa fa-home"></i>
                                 Inicio
                            </a>
                        </div>

                        <div class="mt-3">
                            <small class="text-muted">Última actualización: {{ now()->format('d/m/Y') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


