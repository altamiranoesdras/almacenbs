@extends('layouts.app')

@section('titulo_pagina')
    Editar Solicitud Activos
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">
                        Editar Solicitud Activos
                    </h1>
                </div><!-- /.col -->
                <div class="col">
                    <a class="btn btn-outline-info float-right"
                       href="{{route('activoSolicitudes.index')}}">
                        <i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span
                            class="d-none d-sm-inline">Listado</span>
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

                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-compra" data-toggle="pill"
                                       href="#custom-tabs-four-home" role="tab"
                                       aria-controls="custom-tabs-four-home" aria-selected="true">
                                        Solicitud Activos
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                     aria-labelledby="tab-compra">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            @include('activo_solicituds.show_fields')
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            @include('activo_solicituds.tabla_detalles',['detalles'=>$activoSolicitud->detalles])
                                        </div>

                                        <div class="form-group col-sm-12 text-right">
                                            <a href="{!! route('activoSolicitudes.index') !!}" class="btn btn-outline-secondary">Regresar</a>

                                            @can('anular ingreso de solicitud activos')
                                                @if($activoSolicitud->estado_id != \App\Models\ActivoSolicitudEstado::ANULADA && $activoSolicitud->estado_id == \App\Models\ActivoSolicitudEstado::INGRESADA )
                                                    <a href="#" onclick="deleteItemDt(this)" data-id="{{$activoSolicitud->id}}"
                                                       data-toggle="tooltip" title="Anular Ingreso"
                                                       class='btn btn-outline-danger'>
                                                        Anular Ingreso <i class="fa fa-undo-alt"></i>
                                                    </a>


                                                    <form action="{{ route('activoSolicitudes.anular', $activoSolicitud->id)}}"
                                                          method="POST" id="delete-form{{$activoSolicitud->id}}">
                                                        @method('POST')
                                                        @csrf
                                                    </form>
                                                @endif
                                            @endcan

{{--                                            @can('cancelar solicitud de compra')--}}
{{--                                                @if($compra->estado_id == \App\Models\CompraEstado::CREADA )--}}
{{--                                                    --}}{{--<a href="#modal-delete-{{$compra->id}}" data-toggle="modal" class='btn btn-icon btn-flat-danger rounded-circle'>--}}
{{--                                                    --}}{{--<i class="far fa-trash-alt" data-toggle="tooltip" title="Eliminar Solicitud de Compra"></i>--}}
{{--                                                    --}}{{--</a>--}}
{{--                                                    <span data-toggle="tooltip" title="Cancelar Solicitud de Compra">--}}
{{--                                                        <a href="#modal-delete-{{$compra->id}}" data-toggle="modal" class='btn btn-outline-warning'>--}}
{{--                                                            Cancelar Solicitud de Compra <i class="fas fa-ban"></i>--}}
{{--                                                        </a>--}}
{{--                                                    </span>--}}
{{--                                                @endif--}}
{{--                                            @endcan--}}

                                        </div>

                                    </div>
                                </div>
                            </div>
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

@endsection
