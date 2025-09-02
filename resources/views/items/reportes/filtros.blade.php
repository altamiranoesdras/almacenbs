<div class="card border-info">
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
        <form id="formFiltersDatatables">
            <div class="row">

                <!-- Selector de meses vue-->
                <div class="col-sm-4 mb-1">
                    <label for="meses">Meses a validar: </label>
                    <multiselect v-model="meses" :options="meses_options" track-by="id" label="nombre"
                                 :multiple="false"
                                 placeholder="Selecciones uno">
                    </multiselect>
                    <input type="hidden" name="meses" :value="meses ? meses.id : null">
                </div>

                <!-- Campo -->
                <div class="col-sm-4 mb-1">

                    <div class="form-group col-sm-6">
                        <label for="activo">Incluir insumos vencidos::&nbsp;</label><br>
                        <input type="hidden" name="vencidos" :value="activo ? 1 : 0">
                        <toggle-button v-model="vencidos"
                                       :sync="true"
                                       :labels="{checked: 'SI', unchecked: 'NO'}"
                                       :height="30"
                                       :width="60"
                                       :value="false">

                        </toggle-button>
                    </div>
                </div>



                <!-- Campo -->
                <div class="col-sm-12 mb-1 text-end">
                    <button type="button" @click.prevent="limpiarFormulario()" class="btn btn-outline-secondary me-2">
                        <i class="fa fa-refresh"></i>
                        Limpiar
                    </button>

                    <button type="button" @click.prevent="filtrar()" id="boton" class="btn btn-outline-info">
                        <i class="fa fa-search"></i>
                        Filtrar
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>
</div>


@include('layouts.plugins.bootstrap_daterangepicker')

@push('scripts')
    <script>

        new Vue({
            el: '#formFiltersDatatables',
            name: 'formFilter',
            mounted() {
            },
            created() {
            },
            data: {

                meses_options: [
                    {id: 1, nombre: '1 mes'},
                    {id: 2, nombre: '2 meses'},
                    {id: 3, nombre: '3 meses'},
                    {id: 4, nombre: '4 meses'},
                    {id: 5, nombre: '5 meses'},
                    {id: 6, nombre: '6 meses'},
                ],
                meses: {id: 1, nombre: '1 mes'},
                vencidos: false,
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


