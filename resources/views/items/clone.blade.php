@extends('layouts.app')


@include('layouts.plugins.select2')
@include('layouts.plugins.bootstrap_fileinput')

@section('titulo_pagina')
    Clonar Insumo
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Clonar Insumo</h1>
                </div><!-- /.col -->
                <div class="col">
                    <a class="btn btn-outline-info float-right" href="{!! route('home') !!}">
                        <i class="fa fa-arrow-left"></i>
                        <span class="d-none d-sm-inline">Regresar</span>
                    </a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::model($item,['route' => 'items.store',"enctype"=>"multipart/form-data"]) !!}
                            <div class="row">
                                @include('items.fields')
                                <!-- Submit Field -->
                                    <div class="col-sm-12 mb-1">
                                        <button type="submit" onClick="this.form.submit(); this.disabled=true;" class="btn btn-outline-success">Guardar</button>
                                        <a href="{!! route('items.index') !!}" class="btn btn-outline-secondary">Cancelar</a>
                                    </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    @include('items.modal_form_marcas')
    @include('unimeds.modal_create')
    @include('item_categorias.modal_form_create')
@endsection
