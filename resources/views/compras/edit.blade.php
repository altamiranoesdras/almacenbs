@extends('layouts.app')

@section('titulo_pagina', 'Nuevo Ingreso de almacén')

@include('layouts.plugins.select2')
@include('layouts.xtra_condensed_css')
@include('layouts.plugins.bootstrap_fileinput')

@section('content')


    <x-content-header titulo="Editar ingreso almacén">
        <a class="btn btn-outline-secondary round"
           href="{!! route('bandejas.compras1h.operador') !!}">
            <i class="fa fa-arrow-left"></i>
            <span class="d-none d-sm-inline">Regresar</span>
        </a>
    </x-content-header>

    <div class="content-body" >
        <div class="row">
            <div class="col-12">
                @include('layouts.errores')

                <div class="card border-info">
                    {!! Form::model($compra, ['url' => route('compras.update', $compra->id), 'method' => 'patch','class'=>'esperar']) !!}

                        @include('compras.fields',['compra' => $compra,'modo' => 'edit'])

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection


