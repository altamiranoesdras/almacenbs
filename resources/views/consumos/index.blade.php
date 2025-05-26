@extends('layouts.app')

@section('titulo_pagina',__('Consumos'))

@section('content')

    <x-content-header titulo="consumos">
        <a class="btn btn-outline-success round"
           href="{!! route('consumos.create') !!}">
            <i class="fa fa-plus"></i>
            <span class="d-none d-sm-inline">Nuevo Consumo</span>
        </a>
    </x-content-header>

    <div class="content-body">

        <div class="row">
            <div class="col-lg-12">
                <div class="card border-success">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Filtros</h5>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse hide">
                        <div class="card-body">
                            @include('consumos.usuario.filtros')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-primary">
            @include('consumos.table')
        </div>
    </div>
@endsection

