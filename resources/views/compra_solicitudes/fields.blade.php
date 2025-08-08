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
                                        Monto Estimado {{dvs()}}
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
                                        @click.prevent="save" :disabled="loading" data-toggle="tooltip"
                                        title="Doble enter para agregar">
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


                    <div class="table-responsive mb-3">
                        <table width="100%" class="table table-bordered table-sm" id="tablaDetalle"
                               style="margin-bottom: 2px">
                            <thead class="small table-light">
                            <tr class="text-sm" align="center" style="font-weight: bold">
                                <td width="5%">CANTIDAD</td>
                                <td width="5%">RENGLÓN</td>
                                <td width="5%">CÓDIGO DE INSUMO</td>
                                <td width="20%">NOMBRE</td>
                                <td width="20%">DESCRIPCIÓN</td>
                                <td width="5%">NOMBRE DE LA PRESENTACIÓN</td>
                                <td width="5%">CANTIDAD Y UNIDAD DE MEDIDA</td>
                                <td width="5%">COD. PRESENTACIÓN</td>
                                <td width="5%">MONTO ESTIMADO</td>
                                <td width="5%">SubTotal</td>
                                <td width="5%">-</td>
                            </tr>
                            </thead>
                            <tbody class="small">
                            <tr v-if="detalles.length==0" class="text-center">
                                <td colspan="20"><span
                                        class="help-block ">No se ha agregado ningún artículo</span></td>
                            </tr>
                            <tr v-for="detalle in detalles" class="">
                                <td v-text="nf(detalle.cantidad)"></td>
                                <td v-text="detalle.item.renglon ? detalle.item.renglon.numero : 'Sin renglon'"></td>
                                <td v-text="detalle.item.codigo_insumo"></td>
                                <td v-text="detalle.item.nombre"></td>
                                <td v-text="detalle.item.descripcion"></td>
                                <td v-text="detalle.item.presentacion ? detalle.item.presentacion.nombre : 'Sin unidad'"></td>
                                <td v-text="detalle.item.unimed ? detalle.item.unimed.nombre : 'Sin unidad'"></td>
                                <td v-text="detalle.item.codigo_presentacion"></td>
                                <td v-text="dvs + nfp(detalle.precio_compra)"></td>
                                <td v-text="dvs + nfp(detalle.sub_total)"></td>
                                <td width="10px">

                                    <div class="text-center">
                                        {{--                    <button type="button" class="btn btn-info btn-xs" @click="editDet(detalle)">--}}
                                        {{--                    <i class="fa fa-edit"></i>--}}
                                        {{--                    </button>--}}
                                        <button type="button"
                                                class='btn btn-icon btn-flat-danger rounded-circle'
                                                @click="deleteItem(detalle)" :disabled="detalle.eliminando">
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                  aria-hidden="true"
                                                v-show="idEliminando===detalle.id">
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
                                <td colspan="10">
                                    <b class="float-end">Total monto</b>
                                </td>
                                <td>
                                    <b class="float-end" v-text="dvs + nfp(total)"></b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="10" >
                                    <b class="float-end">
                                        Total insumos
                                    </b>

                                </td>
                                <td>
                                    <b class="float-end" v-text="nf(totalitems)"></b>
                                </td>
                            </tr>
                            </tfoot>

                        </table>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-1">
                            JUSTIFICACIÓN DE LA COMPRA
                            <textarea
                                name="justificacion"
                                id="justificacion"
                                class="form-control"
                                rows="2"
                                placeholder="Justificación de la compra"
                            >{{$compraSolicitud->justificacion ?? ''}}</textarea>
                        </div>

                        <div class="col-6 mb-1">
                            subproductos
                            <table class="table table-sm">
                                <tbody >
                                <tr>
                                    <td>
                                        <input type="text" name="subproductos[]" id="subproductos[]" class="form-control"
                                               value="{{explode('|',$compraSolicitud->subproductos)[0] ?? ''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="subproductos[]" id="subproductos[]" class="form-control"
                                               value="{{explode('|',$compraSolicitud->subproductos)[1] ?? ''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="subproductos[]" id="subproductos[]" class="form-control"
                                               value="{{explode('|',$compraSolicitud->subproductos)[2] ?? ''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="subproductos[]" id="subproductos[]" class="form-control"
                                               value="{{explode('|',$compraSolicitud->subproductos)[3] ?? ''}}">
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="col-6 mb-1">
                            PARTIDAS PRESUPUESTARIAS
                            <table class="table table-sm">
                                <tbody>
                                <tr>
                                    <td>
                                        <input type="text" name="partidas[]" id="partidas[]" class="form-control"
                                               value="{{explode('|',$compraSolicitud->partidas)[0] ?? ''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="partidas[]" id="partidas[]" class="form-control"
                                               value="{{explode('|',$compraSolicitud->partidas)[1] ?? ''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="partidas[]" id="partidas[]" class="form-control"
                                               value="{{explode('|',$compraSolicitud->partidas)[2] ?? ''}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="partidas[]" id="partidas[]" class="form-control"
                                               value="{{explode('|',$compraSolicitud->partidas)[3] ?? ''}}">
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="row mb1">

                        <div class="col-sm-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-danger round" data-bs-toggle="modal"
                                    data-target="#modalAnular">
                                <i class="fa fa-ban"></i> Anular
                            </button>
                        </div>


                        <div class="col-sm-3 text-center">

                            <a href="{!! route('compra.requisiciones.pdf',$compraSolicitud->id ?? 0) !!}"
                               class="btn btn-outline-primary round" target="_blank">
                                <i class="fa fa-print"></i> Imprimir
                            </a>

                        </div>

                        <div class="col-sm-3 text-center">

                            <button type="submit" class="btn btn-outline-success round">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                        </div>

                        @if($compraSolicitud->estado_id !== \App\Models\CompraSolicitudEstado::TEMPORAL)
                            <div class="col-sm-3">
                                <button type="button"  class="btn btn-outline-primary round" @click="procesar()">
                                    <i class="fa fa-paper-plane"></i>
                                    Solicitar
                                </button>
                            </div>
                        @endif
                    </div>


                </div>
            </div>

        </div>
    </div>
    <!--Artículos-->



</div>
<div class="modal fade modal-info" id="modal-confirma-procesar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Solicitar requisición de compra!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Seguro que desea continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                <button type="submit" class="btn btn-primary" name="solicitar" value="1">
                    SI
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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

                procesar: function () {
                    if(this.totalitems>=1){
                        $('#modal-confirma-procesar').modal('show');
                    }else {
                        iziTe('No hay ningún artículo en esta requisición')
                    }
                },

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
