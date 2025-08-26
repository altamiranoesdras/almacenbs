@extends('layouts.app')

@section('titulo_pagina', 'Editar Compra Requisicion' )

@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">
                                                    Editar Compra Requisicion
                                            </h2>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <div class="dropdown">
                    <a class="btn btn-outline-secondary float-right"
                       href="{{ url()->previous() }}"
                    >
                        <i class="fa fa-arrow-left"></i>
                        Regresar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

        <div class="row">
            <div class="col-12">

                @include('layouts.partials.request_errors')

                <div class="card">

                    {!! Form::model($compraRequisicion, ['url' => route('compra.requisiciones.requisicions.update', $compraRequisicion->id), 'method' => 'patch','class' => 'esperar']) !!}

                    <div class="card-body">
                        <div class="row">
                            @include('compra_requisicions.show_fields')
                            @include('compra_requisicions.tabla_detalles_requisicion')
                        </div>
                    </div>

{{--                    <div class="card-footer text-end">--}}

{{--                        <a href="{{ route('compra.requisiciones.requisicions.index') }}"--}}
{{--                           class="btn btn-outline-secondary round me-1">--}}
{{--                            <i class="fa fa-ban"></i>--}}
{{--                            Cancelar--}}
{{--                        </a>--}}

{{--                        <button type="submit" class="btn btn-success round">--}}
{{--                            <i class="fa fa-save"></i>--}}
{{--                            Guardar--}}
{{--                        </button>--}}
{{--                    </div>--}}

                    <div class="row">
                        <div class="col-12 mb-1">
                            JUSTIFICACIÓN DE LA COMPRA
                            <textarea
                                name="justificacion"
                                id="justificacion"
                                class="form-control"
                                rows="2"
                                placeholder="Justificación de la compra"
                            >{{$compraSolicitud->justificacion ?? ''}}</textarea>
                        </div>

                        {{--                        <div class="col-6 mb-1">--}}
                        {{--                            subproductos--}}
                        {{--                            <table class="table table-sm">--}}
                        {{--                                <tbody >--}}
                        {{--                                <tr>--}}
                        {{--                                    <td>--}}
                        {{--                                        <input type="text" name="subproductos[]" id="subproductos[]" class="form-control"--}}
                        {{--                                               value="{{explode('|',$compraSolicitud->subproductos)[0] ?? ''}}">--}}
                        {{--                                    </td>--}}
                        {{--                                </tr>--}}
                        {{--                                <tr>--}}
                        {{--                                    <td>--}}
                        {{--                                        <input type="text" name="subproductos[]" id="subproductos[]" class="form-control"--}}
                        {{--                                               value="{{explode('|',$compraSolicitud->subproductos)[1] ?? ''}}">--}}
                        {{--                                    </td>--}}
                        {{--                                </tr>--}}
                        {{--                                <tr>--}}
                        {{--                                    <td>--}}
                        {{--                                        <input type="text" name="subproductos[]" id="subproductos[]" class="form-control"--}}
                        {{--                                               value="{{explode('|',$compraSolicitud->subproductos)[2] ?? ''}}">--}}
                        {{--                                    </td>--}}
                        {{--                                </tr>--}}
                        {{--                                <tr>--}}
                        {{--                                    <td>--}}
                        {{--                                        <input type="text" name="subproductos[]" id="subproductos[]" class="form-control"--}}
                        {{--                                               value="{{explode('|',$compraSolicitud->subproductos)[3] ?? ''}}">--}}
                        {{--                                    </td>--}}
                        {{--                                </tr>--}}
                        {{--                                </tbody>--}}
                        {{--                            </table>--}}

                        {{--                        </div>--}}
                        {{--                        <div class="col-6 mb-1">--}}
                        {{--                            PARTIDAS PRESUPUESTARIAS--}}
                        {{--                            <table class="table table-sm">--}}
                        {{--                                <tbody>--}}
                        {{--                                <tr>--}}
                        {{--                                    <td>--}}
                        {{--                                        <input type="text" name="partidas[]" id="partidas[]" class="form-control"--}}
                        {{--                                               value="{{explode('|',$compraSolicitud->partidas)[0] ?? ''}}">--}}
                        {{--                                    </td>--}}
                        {{--                                </tr>--}}
                        {{--                                <tr>--}}
                        {{--                                    <td>--}}
                        {{--                                        <input type="text" name="partidas[]" id="partidas[]" class="form-control"--}}
                        {{--                                               value="{{explode('|',$compraSolicitud->partidas)[1] ?? ''}}">--}}
                        {{--                                    </td>--}}
                        {{--                                </tr>--}}
                        {{--                                <tr>--}}
                        {{--                                    <td>--}}
                        {{--                                        <input type="text" name="partidas[]" id="partidas[]" class="form-control"--}}
                        {{--                                               value="{{explode('|',$compraSolicitud->partidas)[2] ?? ''}}">--}}
                        {{--                                    </td>--}}
                        {{--                                </tr>--}}
                        {{--                                <tr>--}}
                        {{--                                    <td>--}}
                        {{--                                        <input type="text" name="partidas[]" id="partidas[]" class="form-control"--}}
                        {{--                                               value="{{explode('|',$compraSolicitud->partidas)[3] ?? ''}}">--}}
                        {{--                                    </td>--}}
                        {{--                                </tr>--}}
                        {{--                                </tbody>--}}
                        {{--                            </table>--}}

                        {{--                        </div>--}}
                    </div>

                    <div class="card-footer">
                        <div class="row mb1">

                            <div class="col-sm-3">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-danger round" data-bs-toggle="modal"
                                        data-target="#modalAnular">
                                    <i class="fa fa-ban"></i> Anular
                                </button>
                            </div>


                            <div class="col-sm-3 text-center">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                                        data-bs-target="#modelId">
                                    Firmar
                                </button>

                                <!-- Modal -->


                            </div>

                            <div class="col-sm-3 text-center">

                                <button type="submit" class="btn btn-outline-success round">
                                    <i class="fa fa-save"></i> Guardar
                                </button>
                            </div>

                            <div class="col-sm-3 text-end">
                                <button type="button"  class="btn btn-outline-primary round">
                                    <i class="fa fa-paper-plane"></i>
                                    Solicitar
                                </button>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog"
                         aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('compra.requisiciones.pdf',$compraRequisicion->id ?? 0) }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="modelTitleId"></h4>
                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            {{-- Usuario --}}
                                            <div class="col-12 mb-1">
                                                <label for="usuario_firma" class="form-label">Usuario</label>
                                                <input class="form-control" type="text" name="usuario_firma" id="usuario_firma"
                                                       value="{{ auth()->user()->email }}">
                                            </div>

                                            {{-- Contraseña de firma --}}
                                            <div class="col-12 mb-1">
                                                <label for="password_firma" class="form-label">Contraseña Firma</label>
                                                <input class="form-control" type="password" name="password_firma" id="password_firma"
                                                       placeholder="******" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cerrar
                                        </button>
                                        <button
                                            type="submit"
                                            class="btn btn-outline-primary round" target="_blank">
                                            <i class="fa fa-print"></i> Firmar e imprimir
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
