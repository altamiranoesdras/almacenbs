
<form id="formFiltersDatatables">

    <div class="row">

        <div class="col-sm-2 mb-1">
            <label for="nit">NIT</label>
            <input type="text" class="form-control" name="nit" value="" >
        </div>

        <div class="col-sm-2 mb-1">
            <label for="codigo_activo">Código Activo</label>
            <input type="text" class="form-control" name="codigo_activo" value="" >
        </div>

        <div class="col-sm-2 mb-1">
            <label for="switch">Asignadas</label>
            <br>
            <input type="checkbox" data-toggle="toggle" data-size="normal" data-on="Si" data-off="No" data-style="ios"
                   name="asignadas"
                   value="1">
        </div>

        <div class="col-sm-12 mb-1" style="padding: 0px; margin: 0px"></div>

        <div class="col-sm-2 mb-1 ">
            <label for="">&nbsp;</label>
            <div>
                <button type="submit" id="boton" class="btn btn-info btn-block">
                    <i class="fa fa-sync"></i> Aplicar Filtros
                </button>
            </div>
        </div>

        <div class="col-sm-2 mb-1">
            <label for="">&nbsp;</label>
            <div>
                <a  href="{{url()->current()}}" type="submit" id="boton" class="btn btn-info btn-block">
                    <i class="fa fa-times"></i> Limpiar Filtros
                </a>
            </div>
        </div>
    </div>
</form>


@push('scripts')

    <script >

        $(function () {
            $('#formFiltersDatatables').submit(function(e){

                e.preventDefault();
                table = window.LaravelDataTables["dataTableBuilder"];

                table.draw();
            });
        })

        new Vue({
            el: '#formFiltersDatatables',
            name: 'formFiltersDatatables',
            created() {

            },
            data: {

                estados_seleccionados: [],
                estados: @json(\App\Models\SolicitudEstado::principales()->get() ?? []),

                unidades_seleccionados: [],
                unidades: @json(\App\Models\RrhhUnidad::with(['usuarios'])->get() ?? []),

                usuarios_seleccionados: [],
                usuarios: @json(\App\Models\User::all() ?? []),



            },
            methods: {

            },
            computed:{

            },
            watch:{

            }
        });
    </script>
@endpush
