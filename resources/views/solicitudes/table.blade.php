@push('estilos_dt')
    @include('layouts.datatables_css')
@endpush

{!! $dataTable->table(['width' => '100%', 'class' => 'table table-sm table-striped table-hover']) !!}

@push('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
        $(function () {
            var dt = LaravelDataTables["dataTableBuilder"];

            //Cuando dibuja la tabla
            dt.on( 'draw.dt', function () {
                $(this).find('tbody').addClass('small');
                $(this).find('thead').addClass('small');
            });


        })
    </script>
@endpush
