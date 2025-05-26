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

                $(".esperar").submit(function( event ) {

                    esperar();
                });
            });


            window.Echo.channel('solicitudes').listen('EventoCambioEstadoSolicitud',(res) => {
                logI('nueva solicitud',res);
                dt.draw();
                new Notification("Nueva requisición para aprobar!");
            });

        })
    </script>
@endpush
