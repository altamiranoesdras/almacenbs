@push('estilos_dt')
    @include('layouts.datatables_css')
@endpush

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped ']) !!}

@push('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}

    <script>
            $(function () {

                var dt = window.LaravelDataTables["dataTableBuilder"];

                //Cuando dibuja la tabla
                dt.on( 'draw.dt', function () {
                    $(this).addClass('table-sm table-striped table-bordered table-hover');
                    $(this).find('tbody').addClass('text-sm');
                    $(this).find('thead').addClass('text-sm');

                    $('[data-toggle="tooltip"]').tooltip();
                });

                window.Echo.channel('solicitudes').listen('EventoCambioEstadoSolicitud',(res) => {
                    logI('Nueva requisición',res);

                    if (res.solicitud){
                        if (res.solicitud.estado_id == @json(\App\Models\SolicitudEstado::SOLICITADA)){

                            logI('redibuja tabla');

                            dt.draw();
                            new Notification("Nueva requisición para autorizar!");
                        }
                    }


                });

            })
        </script>
@endpush
