
<form id="formFiltersDatatables">

    <div class="row">


        <div class="col-sm-2 mb-1">
            <label for="del">DEL:</label>
            <input type="date" class="form-control" name="del_solicita">
        </div>

        <div class="col-sm-2 mb-1">
            <label for="al">AL:</label>
            <input type="date" class="form-control" name="al_solicita">
        </div>


        <div class="col-sm-4 mb-1">
            <label for="tipos">Estado:</label>
            <multiselect v-model="estados_seleccionados" :options="estados" label="nombre" :multiple="true" track-by="id" placeholder="Seleccione uno..." >
            </multiselect>
            <input type="hidden" name="estados[]" v-for="estado in estados_seleccionados" :value="estado.id">
        </div>

        <div class="col-sm-4 mb-1">
            <label for="tipos">Unidad Solicita:</label>
            <multiselect v-model="unidades_seleccionados" :options="unidades" label="nombre" :multiple="true" track-by="id" placeholder="Seleccione uno..." >
            </multiselect>
            <input type="hidden" name="unidades[]" v-for="unidad in unidades_seleccionados" :value="unidad.id">
        </div>

        <div class="col-sm-4 mb-1">
            <label for="tipos">Usuario Solicita:</label>
            <multiselect v-model="usuarios_seleccionados" :options="usuarios" label="name" :multiple="true" track-by="id" placeholder="Seleccione uno..." >
            </multiselect>
            <input type="hidden" name="usuarios_solicita[]" v-for="usuario in usuarios_seleccionados" :value="usuario ? usuario.id : null">
        </div>


        <div class="col-sm-2 mb-1">
            <label for="codigo">Código</label>
            <input type="text" class="form-control" name="codigo" value="">
        </div>


{{--        <div class="col-sm-2 mb-1">--}}
{{--            <label for="switch">Switch</label>--}}
{{--            <br>--}}
{{--            <input type="checkbox" data-toggle="toggle" data-size="normal" data-on="Si" data-off="No" data-style="ios"--}}
{{--                   name="switch"--}}
{{--                   value="1">--}}
{{--        </div>--}}

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
                unidades: @json(\App\Models\RrhhUnidad::with(['usuarios'])->areas()->solicitan()->get() ?? []),

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
