@extends('layouts.app')

@section('titulo_pagina', 'Listado de compras')

@include('layouts.plugins.select2')

@section('content')

    <x-content-header titulo="Listado de compras">
        <a class="btn btn-success float-right"
           href="{{ route('compras.create') }}">
            <i class="fa fa-plus"></i>
            Nueva compra
        </a>
    </x-content-header>

    <div class="content-body">


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
                                        <button type="submit" id="boton" class="btn btn-info">
                                            <i class="fa fa-sync"></i>
                                            Filtrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @include('compras.table')
                        <h3 class="text-muted">
                            Total <span id="count_rows"></span>   registros  <span class="text-success"><span id="total_filtro"></span></span>
                        </h3>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
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
