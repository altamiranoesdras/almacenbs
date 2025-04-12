@push('estilos')
    <style>
        .bootstrap-duallistbox-container select{
            background-color: #283046;
            color: white;
        }
    </style>
    <link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}" />
@endpush
@push('scripts')
    <script>
        $(function (){
            $('.duallistbox').bootstrapDualListbox();

        })
    </script>
    <script type="text/javascript" src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
@endpush
