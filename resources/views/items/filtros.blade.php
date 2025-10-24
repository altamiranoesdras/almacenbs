
<form id="formFiltersDatatables">

    <div class="row">

{{--        <div class="col-sm-3 mb-1">--}}
{{--            <label for="codigo">Código</label>--}}
{{--            <input type="text" class="form-control" name="codigo" value="">--}}
{{--        </div>--}}

        <div class="col-sm-3 mb-1">
            <label for="codigo_insumo">Código Insumo</label>
            <input type="text" class="form-control" name="codigo_insumo" value="">
        </div>

        <div class="col-sm-3 mb-1">
            <label for="codigo_presentacion">Código Presentación</label>
            <input type="text" class="form-control" name="codigo_presentacion" value="">
        </div>

        <div class="col-sm-3 mb-1">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="">
        </div>

        <div class="col-sm-3 mb-1">
            <label for="renglones">Renglón:</label>
            <multiselect v-model="renglones_seleccionados" :options="renglones" label="numero" :multiple="true" track-by="id" placeholder="Seleccione uno..." >
            </multiselect>
            <input type="hidden" name="renglones[]" v-for="renglones in renglones_seleccionados" :value="renglones.id">
        </div>

        <div class="col-sm-6 mb-1">
            <label for="descripcion">Descripción</label>
            <input type="text" class="form-control" name="descripcion" value="">
        </div>



        <div class="col-sm-6 mb-1">
            <label for="tipos">Tipo:</label>
            <multiselect v-model="tipos_seleccionados" :options="tipos" label="nombre" :multiple="true" track-by="id" placeholder="Seleccione uno..." >
            </multiselect>
            <input type="hidden" name="tipos[]" v-for="tipos in tipos_seleccionados" :value="tipos.id">
        </div>



{{--        <div class="col-sm-6 mb-1">--}}
{{--            <label for="marcas">Marca:</label>--}}
{{--            <multiselect v-model="marcas_seleccionados" :options="marcas" label="nombre" :multiple="true" track-by="id" placeholder="Seleccione uno..." >--}}
{{--            </multiselect>--}}
{{--            <input type="hidden" name="marcas[]" v-for="marcas in marcas_seleccionados" :value="marcas.id">--}}
{{--        </div>--}}

        <div class="col-sm-6 mb-1">
            <label for="unidades">Unidad Medida:</label>
            <multiselect v-model="unidades_seleccionados" :options="unidades" label="nombre" :multiple="true" track-by="id" placeholder="Seleccione uno..." >
            </multiselect>
            <input type="hidden" name="unidades[]" v-for="unidades in unidades_seleccionados" :value="unidades.id">
        </div>

        <div class="col-sm-6 mb-1">
            <label for="presentaciones">Presentación:</label>
            <multiselect v-model="presentaciones_seleccionados" :options="presentaciones" label="nombre" :multiple="true" track-by="id" placeholder="Seleccione uno..." >
            </multiselect>
            <input type="hidden" name="presentaciones[]" v-for="presentaciones in presentaciones_seleccionados" :value="presentaciones.id">
        </div>

        <div class="col-sm-6 mb-1">
            <label for="categorias">Categoría:</label>
            <multiselect v-model="categorias_seleccionados" :options="categorias" label="nombre" :multiple="true" track-by="id" placeholder="Seleccione uno..." >
            </multiselect>
            <input type="hidden" name="categorias[]" v-for="categorias in categorias_seleccionados" :value="categorias.id">
        </div>




{{--        <div class="col-sm-6 mb-1">--}}
{{--            <label for="switch">Switch</label>--}}
{{--            <br>--}}
{{--            <input type="checkbox" data-bs-toggle="toggle" data-size="normal" data-on="Si" data-off="No" data-style="ios"--}}
{{--                   name="switch"--}}
{{--                   value="1">--}}
{{--        </div>--}}

        <div class="col-sm-6 mb-1 ">
            <label for="">&nbsp;</label>
            <div>
                <button type="submit" id="boton" class="btn btn-info btn-block">
                    <i class="fa fa-sync"></i> Aplicar Filtros
                </button>
            </div>
        </div>

        <div class="col-sm-6 mb-1">
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
                //agregar a las opciones de multiselect categorías la opción "Sin Categoría"
                this.categorias.push({id: @json(\App\Models\ItemCategoria::SIN_CATEGORIA), nombre: 'Sin Categoría'});

            },
            data: {

                tipos_seleccionados: [],
                tipos: @json(\App\Models\ItemTipo::all() ?? []),

                renglones_seleccionados: [],
                renglones: @json(\App\Models\Renglon::all() ?? []),

                marcas_seleccionados: [],
                marcas: @json(\App\Models\Marca::all() ?? []),

                unidades_seleccionados: [],
                unidades: @json(\App\Models\Unimed::all() ?? []),

                presentaciones_seleccionados: [],
                presentaciones: @json(\App\Models\ItemPresentacion::all() ?? []),

                categorias_seleccionados: [],
                categorias: @json(\App\Models\ItemCategoria::all() ?? []),


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
