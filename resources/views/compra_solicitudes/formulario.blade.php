@extends('layouts.app')

@section('titulo_pagina','Crear Solicitud De Compra')


@include('layouts.plugins.select2')
@include('layouts.xtra_condensed_css')
@include('layouts.plugins.bootstrap_datetimepicker')
@include('layouts.plugins.fancy_box')
@include('layouts.plugins.sweetalert2')

@push('sidebar_class','sidebar-collapse')

@section('content')
    @php
        $titulo = $compraSolicitud->esTemporal() ? 'Crear solicitud de compra' : 'Editar solicitud de compra';
        $subtitulo = $compraSolicitud->esTemporal() ? '' : ' (#'.$compraSolicitud->codigo.')';
    @endphp

    <x-content-header titulo="{{$titulo.$subtitulo}}">
        <a class="btn btn-outline-info float-right"
           href="{{route('compraSolicitudes.index')}}">
            <i class="fa fa-list" aria-hidden="true"></i>&nbsp;<span
                class="d-none d-sm-inline">Listado</span>
        </a>
    </x-content-header>

    <!-- Main content -->
    <div class="content-body">

        @include('layouts.partials.request_errors')


        <form action="{{route('compraSolicitudes.update',$compraSolicitud->id)}}" class="esperar" method="post">
            @method('PATCH')
            @CSRF

            @include('compra_solicitudes.fields')

        </form>

        <!-- Modal -->
        <div class="modal fade" id="modalAnular" tabindex="-1" role="dialog"
             aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('compra.solicitudes.anular',$compraSolicitud->id ?? 0) }}" method="post">
                    @CSRF
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Anular solicitud de compra</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Está seguro de anular la solicitud de compra?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-outline-danger ">
                                <i class="fa fa-ban" aria-hidden="true"></i>&nbsp;
                                Anular
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection
