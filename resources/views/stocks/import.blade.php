@extends('layouts.app')

@section('title_page','Importar existencias de bodegas')
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
                    <ol class="breadcrumb float-right">
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
    <div class="content">
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
                                <div class="form-row">


                                    <div class="form-group col-sm-12">
                                        <div class="row">

                                            <div class="form-group col-sm-3">
                                                <label for="">&nbsp;</label>
                                                <a class="btn btn-outline-success"
                                                   href="{{ asset('importar_stock_cajs.xlsx') }}">
                                                    <i class="fa fa-download"></i>
                                                    <span class="d-none d-sm-inline">Descargar Plantilla</span>
                                                </a>
                                            </div>

                                            <div class="form-group col-sm-9 ">
                                                <img src="{{asset('img/instrucciones_importar_stock.png')}}" style="max-width: 100%" class="img-responsive" alt="Image">
                                            </div>


                                            <div class="form-group col-sm-6 ">
                                                <label for="">Instrucciones:</label>
                                                <ul>
                                                    <li>Descargue la plantilla </li>
                                                    <li>Ingresar los valores correspondientes a cada columna</li>
                                                    <li>No debe alterar los nombres de las columnas o la estructura del documento</li>
                                                    <li>Al terminar de llenar la plantilla, arrastrarla y soltarla en el campo de la derecha y presionar el botón importar</li>
                                                </ul>
                                            </div>
                                            <!-- Imagen Field -->

                                            <div class="form-group col-sm-6 ">
                                                {!! Form::label('file', 'Cargar la plantilla:') !!}
                                                {!! Form::file('file', ['class' => 'form-control file']) !!}
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Submit Field -->
                                    <div class="form-group col-sm-12 text-right">
                                        <a href="{!! route('items.index') !!}" class="btn btn-outline-secondary">
                                            Cancelar
                                        </a>


                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                                data-target="#modelId">
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
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
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
                                                <button type="button" class="btn btn-outline-secondary"
                                                        data-dismiss="modal">Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-outline-success">
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

