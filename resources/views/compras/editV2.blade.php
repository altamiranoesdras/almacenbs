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
                        <i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span class="d-none d-sm-inline">Listado</span>
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
                                    <a class="nav-link active" id="tab-compra" data-toggle="pill" href="#custom-tabs-four-home" role="tab"
                                       aria-controls="custom-tabs-four-home" aria-selected="true">
                                        Compra
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab"
                                       aria-controls="custom-tabs-four-profile" aria-selected="false">
                                        1H
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="tab-compra">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            @include('compras.show_fields')
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            @include('compras.tabla_detalles',['detalles'=>$compra->detalles])
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <a href="{!! route('compras.index') !!}" class="btn btn-default">Regresar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">

                                    @if(!$compra->tiene1h())
                                        <div class="col-12 text-center esperarClick">
                                            <a href="{!! route('compra.generar.1h', $compra->id) !!}" type="button" class="btn btn-outline-primary">
                                                <i class="fa fa-gears"></i> Generar 1H
                                            </a>
                                        </div>
                                    @else
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            @include('compras.tabla_detalles_1h')
                                        </div>

                                        {!! Form::model($compra1h, ['route' => ['compra1hs.update', $compra1h->id], 'method' => 'patch','class' => 'esperar']) !!}
                                        <div class="form-row">

                                            <div class="form-group col-md-12">
                                                <label>Observaciones:</label>
                                                <textarea class="form-control" name="observaciones" rows="2" cols="2">{{ $compra->compra1h->observaciones }}</textarea>
                                            </div>

                                            <!-- Submit Field -->
                                            <div class="form-group col-sm-12">
                                                <a href="{!! route('compras.index') !!}" class="btn btn-outline-secondary">
                                                    Cancelar
                                                </a>

                                                <button type="submit" class="btn btn-outline-success">
                                                    Guardar
                                                </button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    @endif



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

