@extends('layouts.app')

@section('titulo_pagina', 'Opciones')

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Opciones</h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-success"
                       href="{!! route('options.create') !!}">
                        <i class="fa fa-plus"></i>
                        <span class="d-none d-sm-inline">{{__('New')}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card card-primary">
                        <div class="card-body">
                            <ul class="list-group sortable" >
                                @include('admin.options.partials.list_admin')
                            </ul>
                        </div>
                    </div>
                </div>
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

                    var url = "{{route("option.order.store")}}";
                    var params= { params: {opciones: opciones} };

                    console.log(opciones,url);

                    axios.get(url,params).then(response => {
                        console.log(response.data);
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

