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
                    {!! Form::open(['route' => 'compras.libro.almacen','method' => 'get']) !!}

                    <div class="form-row">


                        <div class="form-group col-sm-2">
                            <label for="del">Mes:</label>
                            <input type="month" value="{{$fecha}}" class="form-control" name="fecha" id="fecha">
                        </div>


                        <div class="form-group col-sm-2 pt-2">
                            <labe for="">&nbsp;</labe>
                            <button class="btn btn-success btn-block" id="buscar" type="submit" name="buscar"  value="1">
                                <i class="fa fa-search"></i> Consultar
                            </button>
                        </div>


                        <div class="form-group col-sm-2 pt-2">
                            <labe>&nbsp;</labe>

                            <a  href="{{url()->current()}}" type="submit" id="boton" class="btn btn-info btn-block">
                                <i class="fa fa-times"></i> Limpiar Filtros
                            </a>
                        </div>
                    </div>

                    {!! Form::close() !!}


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


