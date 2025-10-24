@extends('layouts.app')

@section('titulo_pagina', 'Nuevo Ingreso de almacén')

@include('layouts.plugins.select2')
@include('layouts.xtra_condensed_css')
@include('layouts.plugins.bootstrap_fileinput')

@section('content')

    <x-content-header titulo="Nuevo Ingreso de almacén">
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
                    {!! Form::model($temporal, ['url' => route('compras.update', $temporal->id), 'method' => 'patch','class'=>'esperar']) !!}


                        @include('compras.fields',['compra' => $temporal,'modo' => 'create'])


                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cancelar Compra -->
    <div class="modal fade" id="modal-cancel-compra" tabindex="-1" aria-labelledby="modalCancelCompraLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content border-warning">
                <div class="modal-header text-dark">
                    <h5 class="modal-title" id="modalCancelCompraLabel">
                        <i class="fa fa-exclamation-triangle text-warning"></i>
                        Cancelar compra
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea cancelar la compra?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">No</button>
                    <form action="{{ route('compras.destroy', $temporal->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                            Sí, cancelar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


