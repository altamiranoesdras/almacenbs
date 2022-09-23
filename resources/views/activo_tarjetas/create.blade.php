@extends('layouts.app')

@section('title_page',__('New Activo Tarjeta'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('New Activo Tarjeta')}}</h1>
                </div>
                <div class="col ">
                    <a class="btn btn-outline-info float-right"
                       href="{{route('activoTarjetas.index')}}">
                        <i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span class="d-none d-sm-inline">{{__('List')}}</span>
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="container-fluid">

            @include('layouts.partials.request_errors')

            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'activoTarjetas.store','class' => 'esperar']) !!}
                        <div class="form-row">

                            @include('activo_tarjetas.fields')

                            <div class="form-row col-md-12">
                                <div class="alert alert-info alert-dismissible col-md-12">
        {{--                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
                                    <h5><i class="icon fas fa-info"></i> Alerta!</h5> Debe guardar primero para agregar los activos.
                                </div>
                            </div>

                            <!-- Submit Field -->
                            <div class="form-group col-sm-12 text-right">
                                <a href="{!! route('activoTarjetas.index') !!}" class="btn btn-outline-secondary">
                                    Cancelar
                                </a>
                                &nbsp;
                                <button type="submit" class="btn btn-outline-success">
                                    <i class="fa fa-floppy-o"></i> Guardar
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
