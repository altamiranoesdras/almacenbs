@extends('layouts.app')

@section('titulo_pagina',__('Pruebas'))

@include('layouts.plugins.jquery-ui')

@section('content')

    <div id="root">

        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">
                            Pruebas
                        </h2>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">

                </div>
            </div>
        </div>


        <!-- Main content -->

        <div class="content-body">
            <br>
            <div class="row">
                <div class="col">
                    <div class="row">






                      <div class="col-sm-6">
                        <div class="card">
                          <div class="card-body">

                            <form action="{{route('dev.pruebas.enviar.notificacion')}}" method="post" class="esperar">
                                @csrf

                                <h4 class="card-title">Prueba notificación</h4>
                                <p class="card-text">
                                    Enviar notificación de prueba vía email y database (barra superior icono campana)
                                </p>
                                <div class="row">
                                    <div class="col-sm-12 mb-1">
                                        {!! Form::label('Correo', 'Correo:') !!}
                                        {!! Form::text('correo', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success">
                                    Enviar
                                </button>
                            </form>

                          </div>
                        </div>
                      </div>

                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Vista previa correo</h4>

                                    <div class="ratio ratio-16x9">
                                        <iframe id="documento" src="{{route('dev.pruebas.correo.vista.previa')}}"  allowfullscreen></iframe>
                                    </div>

                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

        </div>




    </div>


    <!-- Modal -->

@endsection

@push('scripts')
<script>
    const app = new Vue({
        el: '#app',
        created() {

        },
        data: {

        },
        methods: {

        }
    });
</script>
@endpush

