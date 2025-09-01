<div class="card border-info" id="filtrosDatatables">
<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">
        Filtros
    </h5>
    <div class="heading-elements">
        <ul class="list-inline mb-0">
            <li>
                <a data-action="collapse"><i data-feather="chevron-down"></i></a>
            </li>
        </ul>
    </div>
</div>
<div class="card-content collapse hide">
    <div class="card-body">

        {{--
        El id del formulario se debe llamar formFiltersDatatables ya que este debe coicidir
        con el id del formulario que se usa en el archivo [Modelo]DataTable.php en el metodo html()
         --}}
        <form id="formFiltersDatatables">
            <div class="row">

                <!-- Campo -->
                <div class="col-sm-4 mb-3">
                    <label for="campo_fecha" class="form-label">Campo Fecha:</label>
                    <div class="input-group">
                        <input type="text" class="form-control rangofecha" name="campo_fecha" value="">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fa fa-calendar"></i>
                        </button>
                    </div>
                </div>

                <!-- Campo -->
                <div class="col-sm-4 mb-3">
                    <label for="tipos" class="form-label">Usuarios:</label>
                    <multiselect v-model="usuario" :options="usuarios" label="name" placeholder="Seleccione uno...">
                    </multiselect>
                    <input type="hidden" name="usuarios" :value="usuario ? usuario.id : null">
                </div>

                <!-- Campo -->
                <div class="col-sm-4 mb-3">
                    <label for="estado_id" class="form-label">Estado:</label>
                    <multiselect v-model="estado" :options="estados" track-by="id" label="nombre"
                                 :multiple="true"
                                 placeholder="Seleccione uno">
                    </multiselect>
                    <input type="hidden" name="estados[]" :value="item.id" v-for="item in estado">
                </div>

                <!-- Campo -->
                <div class="col-sm-4 mb-3">
                    <label for="campo_texto" class="form-label">Campo Texto:</label>
                    <input class="form-control" type="text" name="campo_texto">
                </div>

                <!-- Campo -->
                <div class="col-sm-4 mb-3">
                    <label for="campo_numero" class="form-label">Campo Número:</label>
                    <input class="form-control" type="number" step="any" min="0" name="campo_numero">
                </div>

                <!-- Acciones -->
                <div class="col-sm-12 text-end">
                    <button type="button" @click.prevent="limpiarFormulario()" class="btn btn-secondary">
                        <i class="fa fa-refresh"></i> Limpiar
                    </button>
                    &nbsp;
                    <button type="button" @click.prevent="filtrar()" id="boton" class="btn btn-info">
                        <i class="fa fa-search"></i> Filtrar
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
</div>


@push('scripts')
    <script>

        new Vue({
            el: '#filtrosDatatables',
            name: 'filtrosDatatables',
            mounted() {
            },
            created() {
            },
            data: {

                estados: @json([]),
                estado: null,

                usuarios: @json(\App\Models\User::all() ?? []),
                usuario: null,

            },
            methods: {
                filtrar(){

                    table = window.LaravelDataTables["dataTableBuilder"];
                    table.draw();

                },
                limpiarCampos(){
                    this.estado = null;
                    this.usuarios = null;

                    $('#formFiltersDatatables').find('input,select').each(function (index, element) {
                        $(element).val('');
                    });

                },
                async limpiarFormulario(){

                    await this.limpiarCampos();
                    this.filtrar();
                }
            },
            watch:{

            }
        });


    </script>
@endpush

