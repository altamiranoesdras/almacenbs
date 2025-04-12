@extends('layouts.app')

@section('titulo_pagina', 'Roles')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        <h1>Roles</h1>
                    </h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-success float-end round"
                       href="{{ route('roles.create') }}">
                        <i class="fa fa-plus"></i>
                        Agregar
                    </a>
                </div>
            </div>
        </div>
    </div>



    <div class="content-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('admin.roles.table')
                </div>
            </div>
        </div>

    </div>

@endsection
