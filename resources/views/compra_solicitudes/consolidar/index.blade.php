@extends('layouts.app')

@section('titulo_pagina', 'Compra Solicituds')
@include('layouts.plugins.select2')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                        <h1>
                            Consolidar Solicitudes de Compra
                        </h1>
                    </h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-success float-end round"
                       href="{{ route('compra.solicitudes.create') }}">
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
                                    {!! Form::label('$unidad_id','Unidad: ') !!}
                                    {!!
                                        Form::select(
                                            'unidad_id',
                                            select(\App\Models\RrhhUnidad::class,'nombre','id',null)
                                            , $unidad_id ?? null
                                            , ['id'=>'unidades','class' => 'form-control select2-simple','multiple','style'=>'width: 100%']
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
                                            select(\App\Models\Item::enSolicitudCompraActiva(),'text','id',null)
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
                <div class="card" id="consolidarSolicitudes">
                    @include('compra_solicitudes.table')
                    <form
                        action="{{route('compra.solicitudes.consolidar.store')}}"
                        id="formConsolidarSolicitudes"
                        method="POST"
                    >
                        @csrf
                        <input
                            type="hidden"
                            v-for="id in solicitudesAConsolidarIds"
                            name="solicitudes_ids[]"
                            :value="id"
                        >
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>

        function recibirIdDeCheckbox(checkbox) {
            const id = checkbox.value;
            if (checkbox.checked) {
                consolidarSolicitudesVue.solicitudesAConsolidarIds.push(id);
            } else {
                consolidarSolicitudesVue.solicitudesAConsolidarIds = consolidarSolicitudesVue
                    .solicitudesAConsolidarIds
                    .filter(item => item !== id);
            }
        }

        function consolidarSolicitudes(){
            if( consolidarSolicitudesVue.solicitudesAConsolidarIds.length === 0) {
                alert('Debe seleccionar al menos una solicitud para consolidar.');
                return;
            }
            $('#formConsolidarSolicitudes').submit();
        }

        const consolidarSolicitudesVue = new Vue({
            name: 'consolidarSolicitudes',
            el: '#consolidarSolicitudes',
            created() {
                $('#btnConsolidar').attr('disabled', 'disabled');
            },
            data: {
                solicitudesAConsolidarIds : [],
            },
            methods: {

            },
            watch: {
                solicitudesAConsolidarIds: function (val) {
                    if (val.length > 0) {
                        $('#btnConsolidar').removeAttr('disabled');
                    } else {
                        $('#btnConsolidar').attr('disabled', 'disabled');
                    }
                }
            },

        });
        $(function () {
            $('#formFiltersDatatables').submit(function(e){
                e.preventDefault();
                table = window.LaravelDataTables["dataTableBuilder"];
                table.draw();
            });
        })
    </script>
@endpush
