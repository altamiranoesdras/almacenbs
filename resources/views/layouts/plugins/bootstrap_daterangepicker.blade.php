@push('estilos')
<link rel="stylesheet" href="{{asset('css/daterangepicker.css')}}" />
@endpush
@push('scripts')
    <script type="text/javascript" src="{{asset('js/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment/es.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/daterangepicker.js')}}"></script>

    <script>
        $(function () {

            //configuraciones globales
            $.fn.daterangepicker.defaultOptions = {
                locale: {
                    "format": "DD/MM/YYYY",
                    "separator": " - ",
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "Desde",
                    "toLabel": "Hasta",
                    "customRangeLabel": "Personalizado",
                    "weekLabel": "W",
                    "firstDay": 1,
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre",
                    ]
                }
            }

            $('.rangofecha').daterangepicker({
                autoUpdateInput: @json($autoUpdate ?? false),
                ranges: {
                    'hoy': [moment(), moment()],
                    'ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
                    'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
                    'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                    'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().startOf('month'),
                endDate: moment()
            }).on('apply.daterangepicker', function(ev, picker) {

                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));

            }).on('cancel.daterangepicker', function(ev, picker) {

                $(this).val('');

            });
        })

    </script>

@endpush
