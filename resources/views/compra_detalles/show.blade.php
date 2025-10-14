@extends('layouts.app')

@section('titulo_pagina',__('Compra Detalle'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('Compra Detalle')}}</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content-body">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mb-1">
                        @include('compra_detalles.show_fields')
                        <a href="{{ route('compraDetalles.index') }}" class="btn btn-outline-secondary">
                        {{__('Back')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
