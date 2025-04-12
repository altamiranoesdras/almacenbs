@extends('layouts.app')

@section('titulo_pagina',__('Consumo'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('Consumo')}}</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-12">



                        @include('consumos.show_fields')

                    </div>

                    <div class="col-sm-12">
                        @include('consumos.tabla_detalles')
                    </div>

                    <div class="col-sm-12">
                        <a href="{{ route('consumos.index') }}" class="btn btn-default">
                            {{__('Back')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
