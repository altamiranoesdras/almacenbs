@extends('layouts.app')

@section('title_page')
    Libro Almacen
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Libro Almacen</h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="container-fluid">

            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Filtros</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @include('reportes.libro_almacen.filtros')
                </div>
                <!-- /.card-body -->
            </div>

            <div class="clearfix"></div>
            <div class="card card-primary">
                <div class="card-body">

                    @isset(request()->buscar)
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" id="documento"
                                            src="{{route('compras.libro.almacen.pdf')."?mes={$anio}-{$mes}&buscar=1"}}">

                                    </iframe>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="text-center"></div>

        </div>
    </div>

@endsection


