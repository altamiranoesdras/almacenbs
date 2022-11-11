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
            {!! Form::model($temporal, ['route' => ['activoTarjetas.update', $temporal->id], 'method' => 'patch']) !!}

            <div class="card">
                <div class="card-body">

                            @include('activo_tarjetas.fields')

                            @include('activo_tarjetas.panel_detalles')

                        <div class="form-row">

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
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>

@endsection
