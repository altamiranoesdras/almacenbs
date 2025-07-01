@extends('layouts.app')

@section('titulo_pagina', 'Editar Insumo')


@include('layouts.plugins.select2')
@include('layouts.plugins.bootstrap_fileinput')

@section('content')

    <x-content-header titulo="Editar Insumo">
        <a class="btn btn-outline-success round"
           href="{!! route('items.index') !!}">
            <i class="fa fa-arrow-left"></i>
            <span class="d-none d-sm-inline">Volver</span>
        </a>
    </x-content-header>

    <div class="content-body">

        <div class="row">
            <div class="col-12">

                @include('layouts.partials.request_errors')

                <div class="card">
                    {!! Form::model($item, [
                                    'route' => ['items.update', $item->id],
                                     'method' => 'patch',
                                     "enctype"=>"multipart/form-data",
                                     "autocomplete"=>"off",
                                     'class' => 'esperar'
                                 ]) !!}

                    <div class="card-body">

                        @include('items.fields')

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

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
    @include('items.modal_form_marcas')
    @include('unimeds.modal_create')
    @include('item_categorias.modal_form_create')
@endsection

