@extends('layouts.app')

@section('titulo_pagina', 'Compra Solicituds') 
@include('layouts.plugins.select2')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        <h1>Compra Solicituds</h1>
                    </h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-success float-end round"
                       href="{{ route('compra.requisiciones.create') }}">
                        <i class="fa fa-plus"></i>
                        Agregar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col">
                <div class="card card-outline card-success">
                    <div class="card-header p-1">
                        <h3 class="card-title">Filtros</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-2">
                        <form id="formFiltersDatatables">
                            <div class="row">
                                <div class="col-sm-4 mb-1">
                                    {!! Form::label('proveedor_id','Proveedor: ') !!}
                                    {!!
                                        Form::select(
                                            'proveedores',
                                            select(\App\Models\Proveedor::class,'nombre','id',null)
                                            , $proveedor_id ?? null
                                            , ['id'=>'proveedores','class' => 'form-control select2-simple','multiple','style'=>'width: 100%']
                                        )
                                    !!}
                                </div>

                                <div class="col-sm-2 mb-1">
                                    {!! Form::label('del', 'Del:') !!}
                                    {!! Form::date('del', iniMesDb(), ['class' => 'form-control ']) !!}
                                </div>

                                <div class="col-sm-2 mb-1">
                                    {!! Form::label('al', 'Al:') !!}
                                    {!! Form::date('al', hoyDb(), ['class' => 'form-control ']) !!}
                                </div>

                                <div class="col-sm-4 mb-1">
                                    {!! Form::label('item_id','Artículo: ') !!}
                                    {!!
                                        Form::select(
                                            'items',
                                            select(\App\Models\Item::conIngresos(),'text','id',null)
                                            , null
                                            , ['id'=>'items','class' => 'form-control select2-simple','multiple','style'=>'width: 100%']
                                        )
                                    !!}
                                </div>

                                <div class="col-sm-3 mb-1">
                                    {!! Form::label('estado_id','Estado: ') !!}
                                    {!!
                                        Form::select(
                                            'estados',
                                            select(\App\Models\CompraEstado::class,'nombre','id',null)
                                            , null
                                            , ['id'=>'estados','class' => 'form-control select2-simple','multiple','style'=>'width: 100%']
                                        )
                                    !!}
                                </div>



                                <div class="col-sm-3 mb-1">
                                    {!! Form::label('codigo', 'Codigo:') !!}
                                    {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
                                </div>



                                <div class="col-sm-3 mb-1 pl-3">
                                    {!! Form::label('boton','&nbsp;') !!}
                                    <div>
                                        <button type="submit" id="boton" class="btn btn-info">Filtrar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>


    <div class="content-body">

        @include('layouts.partials.request_errors')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    @include('compra_solicitudes.table')
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        $(function () {
            $('#formFiltersDatatables').submit(function(e){
                e.preventDefault();
                table = window.LaravelDataTables["dataTableBuilder"];
                table.draw();
            });
        })
    </script>
@endpush