@extends('layouts.app')

@section('titulo_pagina')
    Libro Almacen
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <x-content-header titulo="Libro Almacen" icono="fas fa-book" ruta="{{route('compras.libro.almacen')}}" />

    <div class="content-body">

        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Filtros</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                {!! Form::open(['route' => 'compras.libro.almacen','method' => 'get']) !!}

                <div class="row">


                    <div class="col-sm-2 mb-1">
                        <label for="del">Mes:</label>
                        <input type="month" value="{{$fecha}}" class="form-control" name="fecha" id="fecha">
                    </div>


                    <div class="col-sm-2 mb-1 pt-2">
                        <labe for="">&nbsp;</labe>
                        <button class="btn btn-success btn-block" id="buscar" type="submit" name="buscar"  value="1">
                            <i class="fa fa-search"></i> Consultar
                        </button>
                    </div>


                    <div class="col-sm-2 mb-1 pt-2">
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
                            <div class="ratio ratio-16x9">
                                <iframe id="documento"
                                        src="{{ route('compras.libro.almacen.pdf') . '?mes=' . $anio . '-' . $mes . '&buscar=1' }}"
                                        allowfullscreen>
                                </iframe>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="text-center"></div>

    </div>

@endsection


