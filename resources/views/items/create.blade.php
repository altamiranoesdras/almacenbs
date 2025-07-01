@extends('layouts.app')

@include('layouts.plugins.select2')
@include('layouts.plugins.bootstrap_fileinput')

@section('titulo_pagina','Nuevo Insumo')


@section('content')

    <x-content-header titulo="Nuevo Insumo">
        <a class="btn btn-outline-success round"
           href="{!! route('items.index') !!}">
            <i class="fa fa-arrow-left"></i>
            <span class="d-none d-sm-inline">Volver</span>
        </a>
    </x-content-header>

    <!-- Main content -->
    <div class="content-body">


            @include('adminlte-templates::common.errors')

            <div class="row">
                <div class="col-lg-12">
                    {!! Form::open(['route' => 'items.store','class' => 'esperar',"enctype"=>"multipart/form-data","autocomplete"=>"off"]) !!}

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @include('items.fields')
                            </div>
                        </div>
                        <div class="card-footer text-end">

                            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary round me-1">
                                <i class="fa fa-ban"></i>
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-success round ">
                                <i class="fa fa-save"></i>
                                Guardar
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->

    </div>
    <!-- /.content -->

    @include('items.modal_form_marcas')
    @include('unimeds.modal_create')
    @include('item_categorias.modal_form_create')
@endsection
