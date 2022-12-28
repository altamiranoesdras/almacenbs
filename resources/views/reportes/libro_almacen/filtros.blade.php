{!! Form::open(['route' => 'compras.libro.almacen','method' => 'get']) !!}

    <div class="form-row">

{{--        <div class="form-group col-sm-2">--}}
{{--            {!! Form::label('mes', 'Mes:') !!}--}}
{{--            {!! Form::date('mes', null, ['class' => 'form-control daterange']) !!}--}}
{{--        </div>--}}

        <div class="form-group col-sm-2">
            <label for="del">Mes:</label>
            <input type="month" class="form-control" name="mes" id="mes">
        </div>

        <div class="col-sm-12"></div>

        <div class="form-group col-sm-2 ">
            <div>
                <button class="btn btn-success btn-block" id="buscar" type="submit" name="buscar"  value="1">
                    <i class="fa fa-search"></i> Consultar
                </button>
            </div>
        </div>

        <div class="form-group col-sm-2">
            <div>
                <a  href="{{url()->current()}}" type="submit" id="boton" class="btn btn-info btn-block">
                    <i class="fa fa-times"></i> Limpiar Filtros
                </a>
            </div>
        </div>
    </div>

{!! Form::close() !!}

@push('scripts')

    <script >

        $(function () {
            $('#formFiltersDatatables').submit(function(e){

                e.preventDefault();
                table = window.LaravelDataTables["dataTableBuilder"];

                table.draw();
            });
        })

        {{--new Vue({--}}
        {{--    el: '#formFiltersDatatables',--}}
        {{--    name: 'formFiltersDatatables',--}}
        {{--    created() {--}}

        {{--    },--}}
        {{--    data: {--}}

        {{--        usuario: null,--}}
        {{--        usuarios: @json(\App\Models\User::all() ?? []),--}}

        {{--    },--}}
        {{--    methods: {--}}

        {{--    },--}}
        {{--    computed:{--}}

        {{--    },--}}
        {{--    watch:{--}}

        {{--    }--}}
        {{--});--}}
    </script>
@endpush
