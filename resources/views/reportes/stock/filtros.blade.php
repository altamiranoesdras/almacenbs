
<form id="formFiltersDatatables">

    <div class="form-row">


        <div class="form-group col-sm-2">
            <label for="del">DEL:</label>
            <input type="date" class="form-control" id="del">
        </div>

        <div class="form-group col-sm-2">
            <label for="al">AL:</label>
            <input type="date" class="form-control" id="al">
        </div>

        <div class="form-group col-sm-4">
            <label for="tipos">Usuarios:</label>
            <multiselect v-model="usuario" :options="usuarios" label="name" placeholder="Seleccione uno..." >
            </multiselect>
            <input type="hidden" name="usuarios" :value="usuario ? usuario.id : null">
        </div>


        <div class="form-group col-sm-2">
            <label for="entrada_texto">Entrada texto</label>
            <input type="text" class="form-control" id="entrada_texto" value="">
        </div>


        <div class="form-group col-sm-2">
            <label for="switch">Switch</label>
            <br>
            <input type="checkbox" data-toggle="toggle" data-size="normal" data-on="Si" data-off="No" data-style="ios"
                   id="switch"
                   value="1">
        </div>

        <div class="form-group col-sm-2 ">
            <label for="">&nbsp;</label>
            <div>
                <button type="submit" id="boton" class="btn btn-info btn-block">
                    <i class="fa fa-sync"></i> Aplicar Filtros
                </button>
            </div>
        </div>

        <div class="form-group col-sm-2">
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

                usuario: null,
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
