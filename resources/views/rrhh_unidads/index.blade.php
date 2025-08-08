@extends('layouts.app')

@section('titulo_pagina',__('Unidades / Dependencias'))

@section('content')

    <!-- Content Header (Page header) -->
    <x-content-header titulo="Unidades / Dependencias">
        <a class="btn btn-outline-success round"
           href="{!! route('rrhhUnidades.create') !!}">
            <i class="fa fa-plus"></i>
            <span class="d-none d-sm-inline">Nueva Unidad</span>
        </a>
    </x-content-header>


    <div class="content-body">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-body">
                    <ul class="list-group sortable" >
                        @include('rrhh_unidads.partials.list_admin')
                    </ul>
                </div>
            </div>
            <div class="text-center">

            </div>
        </div>
    </div>
@endsection

@include('layouts.plugins.jquery-ui')

@push("scripts")
    <script>
        $(function(){


            $( ".sortable" ).sortable({
                update: function( event, ui ) {

                    var  opciones=[];
                    $(this).find('li').each(function (index,elemet) {
                        opciones.push($(this).attr('id'));
                    });

                    var url = "{{route("dev.option.order.store")}}";
                    var params= { params: {opciones: opciones} };

                    axios.get(url,params).then(response => {
                        alertSucces(response.data.message);
                    })
                        .catch(error => {
                            if(error.response){
                                console.log('respuesta ajax: ',error.response.data);

                                alertWarning("Ooops...",error.response.data.message,null)
                            }else {
                                console.log(error);
                            }
                        });

                }
            }).disableSelection();
        });
    </script>
@endpush
