@extends('layouts.app')

@section('titulo_pagina','Importar existencias de bodegas')
@include('layouts.plugins.bootstrap_fileinput')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Importar existencias de bodegas</h1>
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
                            <form action="{{route('stocks.importar.procesar')}}" id="formImport"
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
                                                   href="{{ asset('plantilla_importar_stock_cajs.xlsx') }}">
                                                    <i class="fa fa-download"></i>
                                                    <span class="d-none d-sm-inline">Descargar Plantilla</span>
                                                </a>
                                            </div>

                                            <div class="col-sm-9 mb-1 ">
                                                <img src="{{asset('img/instrucciones_importar_stock.png')}}" style="max-width: 100%" class="img-responsive" alt="Image">
                                            </div>


                                            <div class="col-sm-6 mb-1 ">
                                                <label for="">Instrucciones:</label>
                                                <ul>
                                                    <li>Descargue la plantilla </li>
                                                    <li>Ingresar los valores correspondientes a cada columna</li>
                                                    <li>No debe alterar los nombres de las columnas o la estructura del documento</li>
                                                    <li>Al terminar de llenar la plantilla, arrastrarla y soltarla en el campo de la derecha y presionar el botón importar</li>
                                                </ul>
                                            </div>
                                            <!-- Imagen Field -->

                                            <div class="col-sm-6 mb-1 ">
                                                {!! Form::label('file', 'Cargar la plantilla:') !!}
                                                {!! Form::file('file', ['class' => 'form-control ','id' => 'archivo']) !!}
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Submit Field -->
                                    <div class="col-sm-12 mb-1 text-end">
                                        <a href="{!! route('items.index') !!}" class="btn btn-outline-secondary round me-1">
                                            Cancelar
                                        </a>


                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-success ms-3" data-bs-toggle="modal"
                                                data-bs-target="#modelId">
                                            <i class="fa fa-file-import"></i>
                                            Importar
                                        </button>


                                    </div>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="modelId" tabindex="-1" role="dialog"
                                     aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmar!</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <p>¿Está seguro que desea importar los datos?</p>

                                                <p>Al importar los datos se actualizarán las existencias de los
                                                    productos en las bodegas</p>

                                                <p>Si desea importar los datos, presione el botón
                                                    <strong>Importar</strong></p>

                                                <p>Si desea cancelar la importación, presione el botón
                                                    <strong>Cancelar</strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary round me-1"
                                                        data-bs-dismiss="modal">Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-outline-success round">
                                                    Importar
                                                </button>
                                            </div>
                                        </div>
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

        $("#archivo").fileinput({
            language: "es",
            dropZoneEnabled: true,
            maxFileCount: 1,
            maxFileSize: 5000,
            showUpload: false,
            showBrowse: true,
            showRemove: true,
            theme: "fa",
            browseOnZoneClick: true,
            allowedFileExtensions: ["xls", "xlsx"],
        });

    })
</script>
@endpush

