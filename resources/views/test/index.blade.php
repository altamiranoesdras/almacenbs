@extends('layouts.app')

@section('titulo_pagina', 'Prueba firma electrónica')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Prueba firma electrónica</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Firmar documento</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-secondary" href="{{ route('home') }}">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">

                    <div class="card-body pt-1">
                        <form method="POST" action="{{ route('firmar.documento') }}" enctype="multipart/form-data" class="esperar row g-3">
                            @csrf

                            {{-- Documento --}}
                            <div class="col-6">
                                <label for="documento" class="form-label">Documento a firmar <span class="text-danger">*</span></label>
                                <input class="form-control @error('documento') is-invalid @enderror"
                                       type="file" name="documento" id="documento" required accept=".pdf">
                                @error('documento')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted d-block mt-50">Solo PDF (máx. según tu configuración).</small>
                            </div>

                            {{-- Rúbrica --}}
                            <div class="col-6 ">
                                <label class="form-label">Rúbrica</label>
                                <br>

                                @if(auth()->user()->rubrica)
                                    <div class="border rounded p-1 d-inline-block">
                                        <img class="rounded border" height="120" width="auto"
                                             src="{{ auth()->user()->rubrica }}" alt="Rúbrica de usuario">
                                    </div>
                                    <input type="hidden" name="rubrica_user" value="{{ auth()->user()->rubrica }}">
                                    <small class="text-muted d-block mt-50">Usando rúbrica guardada en tu perfil.</small>
                                @else
                                    <input class="form-control @error('rubrica') is-invalid @enderror"
                                           type="file" name="rubrica" id="rubrica" required accept=".png,.jpg,.jpeg">
                                    @error('rubrica')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-50">Formatos permitidos: PNG, JPG, JPEG.</small>
                                @endif
                                <div class="col-12">



                                    {{-- Lugar y tipo --}}
                                    <div class="col-12 ">
                                        <label for="lugar" class="form-label">Lugar <span class="text-danger">*</span></label>
                                        <input class="form-control @error('lugar') is-invalid @enderror"
                                               type="text" name="lugar" id="lugar" value="Guatemala, Guatemala" required>
                                        @error('lugar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Tipo de solicitud --}}
                                    <div class="col-12 ">
                                        <label for="tipo_solicitud" class="form-label">Tipo de solicitud</label>
                                        <select class="form-select" name="tipo_solicitud" id="tipo_solicitud">
                                            <option value="PDF" selected>PDF</option>
                                            <option value="XML">XML</option>
                                        </select>
                                    </div>

                                    {{-- Concepto --}}
                                    <div class="col-12">
                                        <label for="concepto" class="form-label">Concepto <span class="text-danger">*</span></label>
                                        <input class="form-control @error('concepto') is-invalid @enderror"
                                               type="text" name="concepto" id="concepto" value="test" required>
                                        @error('concepto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Coordenadas y tamaño (mm) --}}
                            <div class="col-12 ">
                                <label class="form-label mb-1">Posición y tamaño de la firma (mm)</label>

                                <div class="row g-2">

                                    <div class="col-2">
                                        <label for="firma_inicio_x" class="form-label">Inicio horizontal (X)</label>
                                        <div class="input-group">
                                            <input class="form-control" type="number" name="firma_inicio_x" id="firma_inicio_x" required value="250" placeholder="X">
                                            <span class="input-group-text">mm</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label for="firma_inicio_y" class="form-label">Inicio vertical (Y)</label>
                                        <div class="input-group">
                                            <input class="form-control" type="number" name="firma_inicio_y" id="firma_inicio_y" required value="15" placeholder="Y">
                                            <span class="input-group-text">mm</span>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <label for="firma_ancho" class="form-label">Ancho</label>
                                        <div class="input-group">
                                            <input class="form-control" type="number" name="firma_ancho" id="firma_ancho" required value="250" placeholder="Ancho">
                                            <span class="input-group-text">mm</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label for="firma_alto" class="form-label">Alto</label>
                                        <div class="input-group">
                                            <input class="form-control" type="number" name="firma_alto" id="firma_alto" required value="65" placeholder="Alto">
                                            <span class="input-group-text">mm</span>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <label for="pagina" class="form-label">Página (opcional)</label>
                                        <input class="form-control" type="number" name="pagina" id="pagina" min="1" placeholder="1">
                                        <small class="text-muted">Si se omite, se usará la página 1.</small>
                                    </div>
                                </div>

                            </div>


                            {{-- Acciones --}}
                            <div class="col-12 d-flex justify-content-end gap-1">


                                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                    Cancelar
                                </a>

                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-signature"></i>
                                    Firmar documento
                                </button>
                            </div>

                        </form>
                    </div> {{-- /card-body --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@include('layouts.plugins.bootstrap_fileinput')

@push('scripts')

    <script>
        $(function () {
            $("#documento").fileinput({
                language: "es",
                initialPreview: @json([]),
                dropZoneEnabled: true,
                maxFileCount: 1,
                maxFileSize: 2000,
                showUpload: false,
                initialPreviewAsData: true,
                showBrowse: true,
                showRemove: true,
                theme: "fa6",
                browseOnZoneClick: true,
                allowedPreviewTypes: ["pdf"],
                allowedFileTypes: ["pdf"],
                initialPreviewFileType: 'pdf',
            }).on('filecleared', function(event) {
                $("#clear_documento").val(1);
            });
        });
    </script>
@endpush
