@@push('estilos_dt')
    @@include('layouts.datatables_css')
@@endpush

@{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped ']) !!}

@@push('scripts')
    @@include('layouts.datatables_js')
    @{!! $dataTable->scripts() !!}
@@endpush
