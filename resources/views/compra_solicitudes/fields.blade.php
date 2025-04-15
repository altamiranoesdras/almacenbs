<div class="row" id="camposSolicitudCompra">

    <!--Artículos-->
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <strong>Artículos</strong>
                    <small class="text-muted text-md">
                        (<i class="fas fa-cubes"></i>Stock)
                    </small>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-content" style="">
                <div class="card-body">

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3">
                            <select-items
                                api="{{route('api.items.index')}}"
                                tienda="{{session('tienda')}}"
                                v-model="itemSelect"
                                ref="multiselect"
                            >
                            </select-items>
                        </div>


                        <div class="col-12 col-sm-3 col-md-3 col-lg-6 mb-1">
                            <div class="input-group">
                                <span class="input-group-text" data-toggle="tooltip" title="Cantidad">Cantidad</span>
                                <input
                                    v-model="editedItem.cantidad"
                                    type="number"
                                    min="0" step="any"
                                    class="form-control"
                                    ref="cantidad"
                                    @keydown.enter.prevent="siguienteCampo('precio_compra')"
                                >
                            </div>
                        </div>

                        <div class=" col-12 col-sm-5 col-md-5 col-lg-6 mb-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Precio Compra {{dvs()}}
                                    </span>
                                </div>


                                <input
                                    v-model="editedItem.precio_compra"
                                    type="number"
                                    min="0" step="any"
                                    ref="precio_compra"
                                    class="form-control"
                                    placeholder="Monto Estimado"
                                    @keydown.enter.prevent="siguienteCampo('agregar')"
                                >
                                <button type="button" ref="agregar" class="btn btn-outline-success waves-effect"
                                        @click.prevent="save" :disabled="loading" data-toggle="tooltip" title="Doble enter para agregar">
                                    <span v-show="loading">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </span>
                                    <span v-show="!loading">
                                        <span v-show="!loading" class="fa fa-plus"></span>
                                    </span>

                                    Agregar
                                </button>
                            </div><!-- /input-group -->

                        </div>
                    </div>



                    <div class="table-responsive">
                        <table width="100%" class="table table-bordered table-sm" id="tablaDetalle"
                               style="margin-bottom: 2px">
                            <thead>
                            <tr class="table-info text-sm" align="center" style="font-weight: bold">
                                <td width="30%">CANTIDAD</td>
                                <td width="20%">RENGLÓN</td>
                                <td width="20%">CÓDIGO DE INSUMO</td>
                                <td width="20%">NOMBRE</td>
                                <td width="20%">DESCRIPCIÓN</td>
                                <td width="20%">NOMBRE DE LA PRESENTACIÓN</td>
                                <td width="20%">CANTIDAD Y UNIDAD DE MEDIDA</td>
                                <td width="20%">COD. PRESENTACIÓN</td>
                                <td width="20%">MONTO ESTIMADO</td>
                                <td width="20%">-</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="detalles.length==0">
                                <td colspan="6"><span
                                        class="help-block text-center">No se ha agregado ningún artículo</span></td>
                            </tr>
                            <tr v-for="detalle in detalles" class="text-sm">
                                <td v-text="detalle.item.nombre"></td>
                                <td v-text="detalle.item.unimed ? detalle.item.unimed.nombre : 'Sin unidad'"></td>
                                <td v-text="dvs + nfp(detalle.precio_compra)"></td>
                                <td v-text="nf(detalle.cantidad)"></td>
                                <td v-text="dvs + nfp(detalle.sub_total)"></td>
                                <td width="10px">

                                    <div class="text-center">
                                        {{--                    <button type="button" class="btn btn-info btn-xs" @click="editDet(detalle)">--}}
                                        {{--                    <i class="fa fa-edit"></i>--}}
                                        {{--                    </button>--}}
                                        <button type="button"
                                                class='btn btn-danger btn-sm waves-effect waves-float waves-light'
                                                @click="deleteItem(detalle)" :disabled="(idEliminando===detalle.id)">
                                        <span v-show="(idEliminando===detalle.id)">
                                            <i class="fa fa-sync-alt fa-spin"></i>
                                        </span>
                                            <span v-show="!(idEliminando===detalle.id)">
                                            <i class="fa fa-trash-alt"></i>
                                        </span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                    <b>Total</b>
                                    <b class="pull-right" v-text="dvs + nfp(total)"></b>
                                </td>
                            </tr>
                            </tfoot>

                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!--Artículos-->

    <!--Resumen-->
    <div class="col-12 col-sm-4 col-md-4 col-lg-4">

        <div class="card card-info card-outline">
            <div class="card-header with-border py-2">
                <h3 class="card-title">
                    <strong>
                        Resumen
                        {{--<small> iniciada: {{fechaHoraLtn($tempVenta->created_at)}}</small>--}}
                    </strong>
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-content ">
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-sm-12">

                            <select-proveedor v-model="proveedor" label="Proveedor"></select-proveedor>
                        </div>

                        <!-- Campo fecha_requiere -->
                        <div class="form-group col-sm-12">
                            <label for="fecha_requiere">Fecha requiere</label>
                            <input
                                type="date"
                                name="fecha_requiere"
                                id="fecha_requiere"
                                class="form-control"
                                value="{{$compraSolicitud->fecha_requiere ? $compraSolicitud->fecha_requiere->format('Y-m-d') : ''}}"
                            >
                        </div>


                        <div class="form-group col-sm-12 text-right">
                            No. Productos: <span v-text="totalitems"></span>
                        </div>
                        <div class="form-group col-sm-12 text-right">
                            Total: {{dvs()}} <span v-text="nfp(total)"></span>
                        </div>
                        <div class="form-group col-sm-12">
                            <textarea
                                name="observaciones"
                                id="observaciones"
                                class="form-control"
                                rows="2"
                                placeholder="Observaciones"
                            >{{$compraSolicitud->observaciones ?? ''}}</textarea>

                        </div>
                    </div>


                </div>
                <div class="card-footer bg-white border-top">
                    <div class="row">

                        <div class="col-sm-6">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-danger btn-block" data-toggle="modal"
                                    data-target="#modalAnular">
                                <i class="fa fa-ban"></i> Anular
                            </button>
                        </div>
                        <div class="col-sm-6">

                            <button type="submit" class="btn btn-outline-success btn-block">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                        </div>
                    </div>

                    <div class="row mt-2">

                        <div class="col-sm-6">

                            <a href="{!! route('compra.solicitudes.pdf',$compraSolicitud->id ?? 0) !!}"
                               class="btn btn-outline-primary mr-2 btn-block" target="_blank">
                                <i class="fa fa-print"></i> Imprimir
                            </a>

                        </div>
                        <div class="col-sm-6">

                            <button type="submit" name="procesar" value="1" class="btn btn-outline-success btn-block">
                                <i class="fa fa-shopping-cart"></i> Generar Compra
                            </button>

                        </div>
                    </div>
                    <!-- Submit Field -->
                </div>
            </div>

        </div>
    </div>
    <!--/Resumen-->

</div>
@push('scripts')
    <!--    Scripts solicitudes de compra
    ------------------------------------------------->
    <script>

        vm = new Vue({
            el: '#camposSolicitudCompra',
            name: 'camposSolicitudCompra',
            mounted() {
                this.abreSelectorItems();
            },
            created: function () {
                this.getItems();
            },
            data: {
                compraSolicitud: @json($compraSolicitud ?? []),

                proveedor: @json($compraSolicitud->proveedor ?? \App\Models\Proveedor::find(old('proveedor_id')) ?? null),

                itemSelect: null,

                detalles: [],

                editedItem: {
                    id: 0,
                    item_id: null,
                    cantidad: 1,
                    precio_venta: 0,
                    precio_compra: 0,
                    solicitud_id: @json($compraSolicitud->id ?? null),
                },
                defaultItem: {
                    id: 0,
                    item_id: null,
                    cantidad: 1,
                    precio_venta: 0,
                    precio_compra: 0,
                    solicitud_id: @json($compraSolicitud->id ?? null),
                },

                loading: false,

                idEliminando: '',
                idEditando: '',
                recibido: 0,
                descuento: 0
            },
            methods: {


                nfp: function (numero) {
                    let decimales = parseInt(@json(config('app.cantidad_decimales_precio')));
                    return number_format(numero, decimales)
                },
                nf: function (numero) {
                    let decimales = parseInt(@json(config('app.cantidad_decimales')));
                    return number_format(numero, decimales)
                },

                getId(item) {
                    if (item)
                        return item.id;

                    return null
                },
                editItem(item) {
                    $("#" + this.id).modal('show');
                    this.editedItem = Object.assign({}, item);

                },
                close() {
                    $("#" + this.id).modal('hide');
                    this.loading = false;
                    setTimeout(() => {
                        this.editedItem = Object.assign({}, this.defaultItem);
                    }, 300)
                },

                async getItems() {

                    try {

                        let params = {params: {solicitud_id: this.compraSolicitud.id}}

                        var res = await axios.get(route('api.compra_solicitud_detalles.index'), params);

                        this.detalles = res.data.data;

                    } catch (e) {
                        notifyErrorApi(e);
                    }

                    this.loading = false;


                },
                async save() {

                    this.loading = true;
                    console.log(this.editedItem);


                    try {

                        this.editedItem.item_id = this.getId(this.itemSelect);
                        const data = this.editedItem;

                        if (this.editedItem.id === 0) {

                            var res = await axios.post(route('api.compra_solicitud_detalles.store'), data);

                        } else {

                            var res = await axios.patch(route('api.compra_solicitud_detalles.update', this.editedItem.id), data);

                        }


                        iziTs(res.data.message);
                        this.editedItem = Object.assign({}, this.defaultItem);
                        this.abreSelectorItems();
                        this.getItems();

                    } catch (e) {
                        notifyErrorApi(e);
                        this.loading = false;
                    }

                },
                async deleteItem(item) {

                    this.idEliminando = item.id;
                    try {
                        let res = await axios.delete(route('api.compra_solicitud_detalles.destroy', item.id))
                        logI(res.data);

                        iziTs(res.data.message);
                        this.getItems();


                    } catch (e) {
                        notifyErrorApi(e);
                        this.idEliminando = '';
                    }


                },

                abreSelectorItems() {
                    this.itemSelect = null;
                    this.$refs.multiselect.$refs.multiselect.$el.focus();

                },
                siguienteCampo: function (campo) {

                    if (campo == 'agregar') {
                        $(this.$refs[campo]).focus().select();
                    } else {

                        $(this.$refs[campo]).focus().select();
                    }
                },
            },
            computed: {
                dvs: function () {
                    return @json(dvs())
                },
                total: function () {
                    var t = 0;

                    $.each(this.detalles, function (i, det) {
                        t += det.cantidad * det.precio_compra;
                    });

                    return t;
                },

                totalitems: function () {
                    var t = 0;
                    $.each(this.detalles, function (i, det) {
                        t += (det.cantidad * 1);
                    });

                    return t;
                },
            },
            watch: {
                itemSelect(item) {

                    if (item) {


                        this.editedItem.precio_venta = item.precio_venta;
                        this.editedItem.precio_compra = item.precio_compra;
                        this.editedItem.item_id = item.id;
                        $(this.$refs.cantidad).focus().select();


                    } else {
                        this.editedItem = Object.assign({}, this.defaultItem);
                    }
                },
            }
        });

    </script>
@endpush
