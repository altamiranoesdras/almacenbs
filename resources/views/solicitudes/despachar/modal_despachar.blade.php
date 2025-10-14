{{$solicitud->codigo}}
{{--Modal de solicitud--}}
<div class="modal fade" id="modal-detalles-{{$solicitud->id}}" tabindex='-1'>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de Requisición</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <form action="{{route('solicitudes.despachar.store',$solicitud->id)}}" method="post" class="esperar">

                @csrf

                <div class="modal-body text-uppercase">
                    <div class="row">
                        <div class="col-12">

                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab{{$solicitud->id}}" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="custom-tabs-four-home-tab{{$solicitud->id}}" data-bs-toggle="pill" data-bs-target="#custom-tab-info{{$solicitud->id}}" type="button" role="tab" aria-controls="custom-tab-info{{$solicitud->id}}" aria-selected="true">
                                                Info
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="custom-tabs-bitacora{{$solicitud->id}}-tab" data-bs-toggle="pill" data-bs-target="#custom-tabs-bitacora{{$solicitud->id}}" type="button" role="tab" aria-controls="custom-tabs-bitacora{{$solicitud->id}}" aria-selected="false">
                                                Bitácora
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="tab-content" id="custom-tabs-four-tabContent{{$solicitud->id}}">
                                        <div class="tab-pane fade show active" id="custom-tab-info{{$solicitud->id}}" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab{{$solicitud->id}}">
                                            <div class="row">
                                                <div class="col-12 text-sm" style="font-size: 14px">
                                                    @include('solicitudes.show_fields',['solicitude'=>$solicitud])
                                                </div>

                                                <div class="col-12">
                                                    @include('solicitudes.despachar.tabla_detalles',['solicitude'=>$solicitud])
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-bitacora{{$solicitud->id}}" role="tabpanel" aria-labelledby="custom-tabs-bitacora{{$solicitud->id}}-tab">
                                            <div class="row">
                                                <div class="col">
                                                    @include('layouts.partials.bitacoras',["bitacoras" => $solicitud->bitacoras->sortByDesc('created_at')])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="display: block !important;">
                    <div class="row">
                        <div class="col-6 ">
                            <button
                                type="button"
                                class="btn btn-outline-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#modalRegresar{{$solicitud->id}}">
                                <i class="fa fa-arrow-left"></i> Retornar a autorización
                            </button>
                        </div>

                        <div class="col-6">

                            {{--                    @if($solicitud->tieneStock())--}}
                            <button type="submit"   class="btn btn-outline-success round float-end">
                                <i class="fa fa-check"></i> Despachar
                            </button>
                            {{--                    @else--}}
                            {{--                        <div class="alert alert-danger" role="alert">--}}
                            {{--                            <strong>No tiene stock suficiente para despachar esta solicitud</strong>--}}
                            {{--                        </div>--}}
                            {{--                    @endif--}}
                        </div>


                    </div>


                </div>


            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalRegresar{{$solicitud->id}}" tabindex="-1" aria-labelledby="tituloRegresar{{$solicitud->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            {{-- Encabezado --}}
            <div class="modal-header">
                <h5 class="modal-title" id="tituloRegresar{{$solicitud->id}}">
                    Retornar a autorización
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('solicitudes.despachar.store', $solicitud->id) }}" method="POST" class="esperar">
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        {!! Form::label('motivo', 'Motivo de retorno:', ['class' => 'form-label fw-semibold']) !!}
                        {!! Form::textarea('motivo', null, [
                            'class' => 'form-control',
                            'rows' => 3,
                            'placeholder' => 'Describa brevemente el motivo del retorno...',
                            'required' => true
                        ]) !!}
                    </div>
                </div>

                {{-- Pie del modal --}}
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i> Cancelar
                    </button>

                    <button
                        type="submit"
                        name="retornar"
                        value="1"
                        class="btn btn-outline-warning"
                        title="Confirmar retorno a autorización"
                    >
                        <i class="fa fa-arrow-left"></i> Regresar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>



