@extends('layouts.app')

@section('htmlheader_title')
	Crear Solicitud
@endsection

@include('layouts.plugins.select2')
@include('layouts.xtra_condensed_css')
@include('layouts.plugins.bootstrap_datetimepicker')
@include('solicitudes.script')

@section('content')
    <!-- Content Header (Page header) -->
    {{--<div class="content-header">--}}
        {{--<div class="container-fluid">--}}
            {{--<div class="row">--}}
                {{--<div class="col">--}}
                    {{--<h1 class="m-0 text-dark">--}}
                        {{--Crear Solicitude--}}
                    {{--</h1>--}}
                {{--</div><!-- /.col -->--}}
                {{--<div class="col ">--}}
                    {{--<a class="btn btn-outline-info float-right"--}}
                       {{--href="{{route('solicitudes.index')}}">--}}
                        {{--<i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span class="d-none d-sm-inline">Listado</span>--}}
                    {{--</a>--}}
                {{--</div><!-- /.col -->--}}
            {{--</div><!-- /.row -->--}}
        {{--</div><!-- /.container-fluid -->--}}
    {{--</div>--}}
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            @include('adminlte-templates::common.errors')

            <div class="row mt-2" id="root">


                    <!-- Articulos -->
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="card card-secondary">
                            <div class="card-header with-border">
                                <h3 class="card-title">
                                    <strong>Artículos</strong>
                                </h3>
                                <div class="card-tools pull-right">
                                    {{--<button class="btn btn-tool" data-widget="collapse" tabindex="1000"><i class="fa fa-minus"></i></button>--}}
                                    {{--<button class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <select  id="items" class="form-control" multiple="multiple" size="10" style="width: 100%;">
                                        <option value=""> -- Select One -- </option>
                                    </select>
                                </div>

                                <div class="row pt-3">

                                    <div class="form-group  col">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-toggle="tooltip" title="Precio compra">Cantidad</span>
                                            </div>
                                            <input v-model="nuevoDetalle.cantidad" type="text" id="cantidad-new-det" class="form-control" placeholder="Cantidad" data-toggle="tooltip" title="Doble Enter para agregar">
                                            <span class="input-group-append">
                                                    <button type="button" id="btn-agregar" class="btn btn-success" v-on:click.prevent="createDet" :disabled="loadingBtnAdd" >
                                                        <i  v-show="loadingBtnAdd" class="fa fa-spinner fa-spin"></i>
                                                        <span v-show="!loadingBtnAdd" class="glyphicon glyphicon-plus"></span>
                                                        Agregar
                                                    </button>
                                                </span>
                                        </div><!-- /input-group -->

                                    </div>


                                </div>

                                <div id="div-info-item"></div>
                                @include('solicitudes.tabla_det_vue')
                            </div>
                        </div>
                    </div>
                    <!-- /. Articulos -->

                    <!-- Resumen -->
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="card card-secondary ">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <strong>
                                        Solicitud <small>iniciada: {{fechaHoraLtn($tempSolicitude->created_at)}}</small>
                                    </strong>
                                </h3>
                                <div class="card-tools pull-right">
                                    {{--<button class="btn btn-tool" data-widget="collapse" tabindex="1000"><i class="fa fa-minus"></i></button>--}}
                                    {{--<button class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                {!! Form::model($tempSolicitude, ['route' => ['solicitudes.update', $tempSolicitude->id], 'method' => 'patch','id'=>'firstForm']) !!}
                                    @include('solicitudes.fields')
                                {!! Form::close() !!}
                            </div>
                        </div><!-- /.row -->
                    </div>
                    <!-- /. Resumen -->

                @include('solicitudes.modal_edit_det')
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->



@endsection
