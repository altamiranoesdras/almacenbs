@extends('layouts.app')

@section('titulo_pagina', 'Insumos')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        Insumos
                    </h2>
                </div>
            </div>
        </div>

        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-primary float-end"
                       href="{{ route('items.create') }}">
                        Agregar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        

        <div class="card border-info">
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
                @include('items.filtros')
            </div>
        </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('items.table')
                </div>
            </div>
        </div>

    </div>

@endsection
