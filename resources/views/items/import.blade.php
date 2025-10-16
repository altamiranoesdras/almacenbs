@extends('layouts.app')

@section('titulo_pagina','Importar articulos')
@include('layouts.plugins.bootstrap_fileinput')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Importar articulos</h1>
                </div><!-- /.col -->
                <div class="col">
                    <ol class="breadcrumb float-end">
                        <li class="breadcrumb-item">

                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
    <div class="content-body">
        <div class="container-fluid">

            @include('layouts.errores')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('items.importar.store')}}" id="formImport"
                                  method="post"
                                  enctype='multipart/form-data'
                                  autocomplete='off'
                                  class='esperar'
                            >
                                @csrf
                                <div class="row">


                                    <div class="col-sm-12 mb-1">
                                        <div class="row">

                                            <div class="col-sm-3 mb-1">
                                                <label for="">&nbsp;</label>
                                                <a class="btn btn-outline-success round"
                                                   href="{{ asset('plantilla_importar_articulos.xlsx') }}">
                                                    <i class="fa fa-download"></i>
                                                    <span class="d-none d-sm-inline">Descargar Plantilla</span>
                                                </a>
                                            </div>

                                            <div class="col-sm-9 mb-1 ">
                                                <img src="{{asset('instrucciones_importar_articulos.PNG')}}" style="max-width: 100%" class="img-responsive" alt="Image">
                                            </div>


                                            <div class="col-sm-6 mb-1 ">
                                                <label for="">Instrucciones:</label>
                                                <ul>
                                                    <li>Descargue la plantilla </li>
                                                    <li>Ingresar los valores correspondientes a cada columna</li>
                                                    <li>Las columnas en amarillo son obligatorias, el resto de columnas puede dejarlas en blanco</li>
                                                    <li>No debe alterar los nombres de las columnas o la estructura del documento</li>
                                                    <li>La columna código puede ser el código de barras o un correlativo</li>
                                                    <li>Al terminar de llenar la plantilla, arrastrarla y soltarla en el campo de la derecha y presionar el botón importar</li>
                                                </ul>
                                            </div>
                                            <!-- Imagen Field -->

                                            <div class="col-sm-6 mb-1 ">
                                                {!! Form::label('file', 'Cargar la plantilla:') !!}
                                                {!! Form::file('file', ['class' => 'form-control file']) !!}
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Submit Field -->
                                    <div class="col-sm-12 mb-1 text-end">
                                        <a href="{!! route('items.index') !!}" class="btn btn-outline-secondary round me-1">
                                            Cancelar
                                        </a>

                                        <button type="submit" id="btnSubmit"  class="btn btn-outline-success  mx-2">
                                            Importar
                                        </button>
                                    </div>
                                </div>
                            </form>
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
    <!-- /.content -->
@endsection

@push('scripts')
<script>
    $(function () {

        $("#formImport").submit(function (e) {
            e.preventDefault();

            $("#btnSubmit").prop('disabled',true);

            this.submit();

            Swal.fire({
                allowOutsideClick: false,
                title: 'Importando!',
                html: `Espera un momento por favor...`,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });



        });

    })
</script>
@endpush

