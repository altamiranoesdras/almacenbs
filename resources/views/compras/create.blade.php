@extends('layouts.app')

@section('htmlheader_title','Compra o Ingreso')


@include('layouts.plugins.select2')
@include('layouts.xtra_condensed_css')
@include('layouts.plugins.bootstrap_datetimepicker')
@include('layouts.plugins.bootstrap_fileinput')
@include('compras.script')

@push('sidebar_class','sidebar-collapse')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header pb-1 pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">
                        Nueva Compra o Ingreso
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" id="root">
        <div class="container-fluid">


            @include('layouts.errores')

            {!! Form::model($temporal, ['route' => ['compras.update', $temporal->id], 'method' => 'patch']) !!}
            <div class="row mt-2">

                    <!-- Articulos -->
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="card card-warning card-outline">
                            <div class="card-header with-border py-2">
                                <h3 class="card-title">
                                    <strong>Artículos</strong>
                                    <small class="text-muted text-md">
                                        (<i class="fas fa-cubes"></i>Stock)
                                        (<i class="fas fa-archive"></i>Ubicacion)
                                    </small>
                                </h3>
                                <div class="card-tools pull-right">
                                    {{--<button class="btn btn-tool" data-widget="collapse" tabindex="1000"><i class="fa fa-minus"></i></button>--}}
                                    {{--<button class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <a class="success" data-toggle="modal" href="#modal-form-items" tabindex="1000">Crear Nuevo</a>
                                    <select  id="items" class="form-control" multiple="multiple" size="10" style="width: 100%;">
                                        <option value=""> -- Select One -- </option>
                                    </select>
                                </div>

                                <div class="row pt-3">
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-toggle="tooltip" title="Fecha Vence">FV</span>
                                            </div>
                                            <input v-model="nuevoDetalle.fecha_ven" id="fv-new-det" type="date" name="fecha_ven"  class="form-control"  data-toggle="tooltip" title="Doble Enter para agregar">
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-toggle="tooltip" title="Cantidad">Cant</span>
                                            </div>
                                            <input v-model="nuevoDetalle.cantidad" type="number" min="0" step="1" name="cantidad" id="cant-new-det"  class="form-control"  value="1" data-toggle="tooltip" title="Doble Enter para agregar">
                                        </div>
                                    </div>
                                    <div class="form-group  col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-toggle="tooltip" title="Precio compra">{{ dvs() }}</span>
                                            </div>
                                            <input v-model="nuevoDetalle.precio" type="number" min="0" step="1" id="precio-new-det" class="form-control" placeholder="Precio compra" data-toggle="tooltip" title="Doble Enter para agregar">
                                            <span class="input-group-append">
                                                    <button type="button" id="btn-agregar" class="btn btn-success" v-on:click.prevent="createDet" :disabled="loadingBtnAdd" >
                                                        <span v-show="loadingBtnAdd" >
                                                            <i class="fa fa-sync-alt fa-spin"></i>
                                                        </span>
                                                        <span v-show="!loadingBtnAdd" class="glyphicon glyphicon-plus"></span>
                                                        Agregar
                                                    </button>
                                                </span>
                                        </div><!-- /input-group -->

                                    </div>
                                </div>

                                <div id="div-info-item"></div>

                                @include('compras.tabla_det_vue')
                            </div>
                        </div>
                    </div>
                    <!-- /. Articulos -->

                    <!-- Resumen -->
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="card card-warning card-outline">
                            <div class="card-header py-2">
                                <h3 class="card-title">
                                    <strong>
                                        Resumen
                                        {{--<small>iniciada: {{fechaHoraLtn($temporal->created_at)}}</small>--}}
                                    </strong>
                                </h3>
                                <div class="card-tools pull-right">
                                    {{--<button class="btn btn-tool" data-widget="collapse" tabindex="1000"><i class="fa fa-minus"></i></button>--}}
                                    {{--<button class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="padding: 0px;">

                                @include('compras.fields')

                            </div>
                        </div><!-- /.row -->
                    </div>
                    <!-- /. Resumen -->


{{--                @include('ventas.edit_modal_detalle')--}}
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    @include('compras.modal_provs')
    @include('items.modal_form_create')

@endsection
