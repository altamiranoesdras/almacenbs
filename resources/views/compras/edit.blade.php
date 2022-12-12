@extends('layouts.app')

@section('title_page')
    Editar Compra
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">
                        Editar Compra
                    </h1>
                </div><!-- /.col -->
                <div class="col">
                    <a class="btn btn-outline-info float-right"
                       href="{{route('compras.index')}}">
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

                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Ingreso</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    @include('compras.show_fields')
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    @include('compras.tabla_detalles',['detalles'=>$compra->detalles])
                                </div>

                                <div class="form-group col-sm-12 text-right">
                                    <a href="{!! route('compras.index') !!}" class="btn btn-outline-secondary">Regresar</a>

                                    @can('anular ingreso de compra')
                                        @if($compra->estado_id != \App\Models\CompraEstado::ANULADA && $compra->estado_id == \App\Models\CompraEstado::RECIBIDA )
                                            <a href="#" onclick="deleteItemDt(this)" data-id="{{$compra->id}}"
                                               data-toggle="tooltip" title="Anular Ingreso"
                                               class='btn btn-outline-danger'>
                                                Anular Ingreso <i class="fa fa-undo-alt"></i>
                                            </a>


                                            <form action="{{ route('compras.anular', $compra->id)}}"
                                                  method="POST" id="delete-form{{$compra->id}}">
                                                @method('POST')
                                                @csrf
                                            </form>
                                        @endif
                                    @endcan

                                    @can('cancelar solicitud de compra')
                                        @if($compra->estado_id == \App\Models\CompraEstado::CREADA )
                                            {{--<a href="#modal-delete-{{$compra->id}}" data-toggle="modal" class='btn btn-danger btn-xs'>--}}
                                            {{--<i class="far fa-trash-alt" data-toggle="tooltip" title="Eliminar Solicitud de Compra"></i>--}}
                                            {{--</a>--}}
                                            <span data-toggle="tooltip" title="Cancelar Solicitud de Compra">
                                                        <a href="#modal-delete-{{$compra->id}}" data-toggle="modal" class='btn btn-outline-warning'>
                                                            Cancelar Solicitud de Compra <i class="fas fa-ban"></i>
                                                        </a>
                                                    </span>
                                        @endif
                                    @endcan
                                    @if($compra->estado_id == \App\Models\CompraEstado::CREADA )
                                        <a href="{!! route('compra.ingreso',$compra->id) !!}" class="btn btn-outline-success">
                                            Ingresar
                                        </a>
                                    @endif

                                </div>


                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">1H</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(!$compra->estaRecibida())
                                <h3 class="text-info">
                                    El estado de la compra debe ser
                                    <span class="badge badge-info">
                                        {{\App\Models\CompraEstado::find(\App\Models\CompraEstado::RECIBIDA)->nombre}}
                                    </span>
                                    para poder generar 1H
                                </h3>
                            @endif
                            @if(!$compra->tiene1h())
                                <div class="col-12 text-center esperarClick">
                                    <a href="{!! route('compra.generar.1h', $compra->id) !!}" type="button"
                                       class="btn btn-outline-primary">
                                        <i class="fa fa-gears"></i> Generar 1H
                                    </a>
                                </div>
                            @else
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    @include('compras.tabla_detalles_1h')
                                </div>

                                    <form action="{{route('compra.actualiza.1h',$compra->id)}}" method="post">
                                        @csrf
                                        <div class="form-row">

                                            <div class="form-group col-md-12">
                                                <label>Observaciones:</label>
                                                <textarea class="form-control" name="observaciones" rows="2" cols="2">{{ $compra->compra1h->observaciones }}</textarea>
                                            </div>

                                            <!-- Submit Field -->
                                            <div class="form-group col-sm-12 text-right">
                                                <a href="{!! route('compras.index') !!}" class="btn btn-outline-secondary">
                                                    Regresar
                                                </a>


                                                <button type="submit" class="btn btn-outline-success">
                                                    Actualizar
                                                </button>

                                                <a href="{{route('compra.h1.pdf',$compra->id)}}" target="_blank"
                                                   class='btn btn-outline-primary' data-toggle="tooltip"
                                                   title="Imprimir 1H">
                                                    Imprimir 1H
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->


@endsection


@push('scripts')
    <script >

        $(".esperarClick").on('click', function( event ) {

            Swal.fire({
                title: 'Espera por favor...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                timerProgressBar: true,
            });

            Swal.showLoading();
        });

    </script>
@endpush

