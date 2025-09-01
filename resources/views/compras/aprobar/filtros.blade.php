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

                    <div class="col-6 mb-1">
                        <label for="unidad_solicitante">Unidad Solicitante</label>
                        <multiselect
                            v-model="unidadadSeleccionada"
                            :options="unidades"
                            label="nombre_con_padre"
                            track-by="id">
                        </multiselect>
                        <input type="hidden" name="unidad_solicitante" :value="unidadadSeleccionada ? unidadadSeleccionada.id : ''">
                    </div>

                    <div class="col-sm-6 mb-1">
                        {!! Form::label('proveedor_id','Proveedor: ') !!}
                        {!!
                            Form::select(
                                'proveedores',
                                select(\App\Models\Proveedor::class,'nombre','id',null)
                                , $proveedor_id ?? null
                                , ['id'=>'proveedores','class' => 'form-control select2-simple','multiple','style'=>'width: 100%']
                            )
                        !!}
                    </div>

                    <div class="col-sm-2 mb-1">
                        {!! Form::label('del', 'Del:') !!}
                        {!! Form::date('del', iniMesDb(), ['class' => 'form-control ']) !!}
                    </div>

                    <div class="col-sm-2 mb-1">
                        {!! Form::label('al', 'Al:') !!}
                        {!! Form::date('al', hoyDb(), ['class' => 'form-control ']) !!}
                    </div>

                    <div class="col-sm-2 mb-1">
                        {!! Form::label('codigo', 'Codigo:') !!}
                        {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="col-sm-2 mb-1">
                        {!! Form::label('h1', 'H1:') !!}
                        {!! Form::text('h1', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="col-sm-2 mb-1">
                        {!! Form::label('orden_compra', 'Orden de Compra:') !!}
                        {!! Form::text('orden_compra', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="col-sm-6 mb-1">
                        {!! Form::label('item_id','Artículo: ') !!}
                        {!!
                            Form::select(
                                'items',
                                select(\App\Models\Item::conIngresos(),'text','id',null)
                                , null
                                , ['id'=>'items','class' => 'form-control select2-simple','multiple','style'=>'width: 100%']
                            )
                        !!}
                    </div>

                    <div class="col-sm-6 mb-1">
                        {!! Form::label('estado_id','Estado: ') !!}
                        {!!
                            Form::select(
                                'estados',
                                select(\App\Models\CompraEstado::class,'nombre','id',null)
                                , null
                                , ['id'=>'estados','class' => 'form-control select2-simple','multiple','style'=>'width: 100%']
                            )
                        !!}
                    </div>


                    <!-- Acciones -->
                    <div class="col-sm-12 text-end">
                        <button type="button" @click.prevent="limpiarFormulario()" class="btn btn-outline-secondary">
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

                unidades: @json(\App\Models\RrhhUnidad::areas()->solicitan()->get()),
                unidadadSeleccionada: null

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

