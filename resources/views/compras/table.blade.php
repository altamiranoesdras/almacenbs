@push('estilos_dt')
    @include('layouts.datatables_css')
@endpush

{!! $dataTable->table(['width' => '100%', 'class' => 'table-sm table-striped']) !!}

@push('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script>
        $(function () {
            var dt = LaravelDataTables["dataTableBuilder"];

            //Cuando dibuja la tabla
            dt.on( 'draw.dt', function () {
                console.log('draw.dt');
                $(this).find('tbody').addClass('small');
                $(this).find('thead').addClass('small');

                $('[data-toggle="tooltip"]').tooltip();


                var totalRegistros= dt.ajax.json().count_rows;

                $("#total_deuda").text(dt.ajax.json().total);
                $("#count_rows").text(totalRegistros);
                $("#total_filtro").text(dt.ajax.json().totalFilter);
            });


        })
    </script>
@endpush
