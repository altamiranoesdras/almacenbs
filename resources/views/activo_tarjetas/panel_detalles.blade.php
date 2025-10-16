<div class="card" id="form_tarjeta_detalle">
    <div class="card-header" >
        <div class="row">
            <div class="col-sm-6">
                <h5 class="card-title mb-0">
                    Activos o Bienes
                </h5>
            </div>
            <div class="col-sm-6 text-end">
                <button type="button" class="btn btn-success btn-sm" @click="crearItem()">
                    <i class="fa fa-plus"></i> Nuevo activo
                </button>
            </div>
        </div>
    </div>

    <div class="card-body" >


        <div class="modal fade" id="modal_form_tarjeta_detalle" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId" v-text="tituloModal"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="save()">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-sm-12 mb-1">
                                    <label for="descripcion">Descripción</label>
                                    <select-activo v-model="activo" label="activo" ></select-activo>
                                </div>

{{--                                <div class="col-sm-4 mb-1">--}}
{{--                                    <label for="">Tipo</label>--}}
{{--                                    <multiselect v-model="tipo" :options="tipos"></multiselect>--}}
{{--                                </div>--}}

                                <div class="col-sm-4 mb-1">
                                    <label for="precio">Fecha Asigna</label>
                                    <input @keydown.enter.prevent="save()" type="date" class="form-control" id="precio" v-model="editedItem.fecha_asigna">
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" @click="save()">
                                <i class="fa fa-save"></i> <span v-text="textoBotonGuardar"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <table class="table table-bordered table-striped table-sm table-hover">
            <thead>
            <tr>
                <th>id</th>
                <th>Descripción del bien</th>
                <th>No. Bien</th>
                <th>ALZA</th>
                <th>BAJA</th>
                <th>Saldo</th>
                <th>Fecha asigna</th>
                <th width="10%">Acciones</th>
            </tr>
            </thead>
            <tbody>

                <tr v-if="detalles.length == 0">
                    <td colspan="10" class="text-center">Ningún Registro agregado</td>
                </tr>

                <tr v-for="(detalle,index) in detalles" >
                    <td v-text="detalle.id"></td>
                    <td v-text="detalle.activo.nombre"></td>
                    <td v-text="detalle.activo.codigo_inventario"></td>
                    <td v-text="valorAlza(detalle)"></td>
                    <td v-text="valorBaja(detalle)"></td>
                    <td v-text="dvs+nfp(getSaldo(detalle,index))"></td>
                    <td v-text="formatoFecha(detalle.fecha_asigna)"></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-info btn-sm" v-tooltip="'Editar'" @click="editItem(detalle)">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-warning btn-sm" v-tooltip="'Dar Baja'" @click="darBajaItem(detalle)" v-show="detalle.tipo!=tipo_baja">
                            <i class="fa fa-ban"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" v-tooltip="'Eliminar'" @click="deleteItem(detalle)">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
        </table>
    </div>
</div>


@push('scripts')
<script>
    new Vue({
        el: '#form_tarjeta_detalle',
        name: 'form_tarjeta_detalle',
        created() {

            this.getDetalles();

        },
        data: {
            tarjeta: @json($tarjeta ?? null),
            activo: null,
            tipo: null,
            tipos: [@json(\App\Models\ActivoTarjetaDetalle::ALZA),@json(\App\Models\ActivoTarjetaDetalle::BAJA)],

            detalles: [],

            editedItem: {
                id: 0,
                tarjeta_id: @json($tarjeta->id),
                activo_id: null,
                tipo: @json(\App\Models\ActivoTarjetaDetalle::ALZA),
                cantidad: 1,
                valor_actual: null,
                unidad_id: null,
                fecha_asigna: null,
            },

            defaultItem: {
                id: 0,
                tarjeta_id: @json($tarjeta->id),
                activo_id: null,
                tipo: @json(\App\Models\ActivoTarjetaDetalle::ALZA),
                cantidad: 1,
                valor_actual: null,
                unidad_id: null,
                fecha_asigna: null,
            },

            itemElimina: {},

            loading: false,
            saldo : 0,
            tipo_baja : @json(\App\Models\ActivoTarjetaDetalle::BAJA),
        },
        methods: {
            valorAlza(detalle){
                if (detalle.valor_alza){
                    return this.dvs+this.nfp(detalle.valor_alza);
                }

                return null;
            },
            valorBaja(detalle){
                if (detalle.valor_baja){
                    return this.dvs+this.nfp(detalle.valor_baja)
                }
            },
            getSaldo(detalle,index1){


                let saldo = 0;

                let detalles = this.detalles;

                detalles.some(function (item,index2){




                    let alza = parseFloat(item.valor_alza || 0);
                    let baja = parseFloat(item.valor_baja || 0);


                    saldo += alza;
                    saldo -= baja;

                    return index1===index2;


                })

                console.log(saldo)


                return saldo

            },
            nfp(numero){


                if (numero!=='' && numero!==null){

                    return number_format(numero,2);
                }

                return null;
            },
            formatoFecha(fecha) {
                return fecha ? moment(fecha).format("YYYY/MM/DD") : '';
            },
            getId(item){
                if(item)
                    return item.id;

                return null
            },

            editItem(item) {

                this.editedItem = Object.assign({}, item);
                $('#modal_form_tarjeta_detalle').modal('show');

            },
            crearItem() {
                this.editedItem = Object.assign({}, this.defaultItem);
                $('#modal_form_tarjeta_detalle').modal('show');
            },
            btn-close () {
                $('#modal_form_tarjeta_detalle').modal('hide');
                this.loading = false;
                this.editedItem = Object.assign({});
            },

            async getDetalles() {

                try {

                    let res = await axios.get(route('api.activo_tarjeta_detalles.index',{tarjeta_id : this.tarjeta.id}));

                    this.detalles = res.data.data;

                } catch (e) {

                    notifyErrorApi(e)

                }

            },

            async save () {

                this.loading = true;


                try {

                    let data = this.editedItem;
                    // data.unidad_id = this.tarjeta.responsable.unidad_id;
                    data.activo_id = this.activo.id;
                    data.valor = this.activo.valor_actual;
                    let res = null;

                    if(this.editedItem.id === 0){

                        res = await axios.post(route('api.activo_tarjeta_detalles.store'),data);

                    }else {

                        res = await axios.patch(route('api.activo_tarjeta_detalles.update',this.editedItem.id),data);

                    }

                    logI(res.data);

                    iziTs(res.data.message);
                    this.getDetalles();

                    this.btn-close();

                }catch (e) {
                    notifyErrorApi(e);
                    this.loading = false;
                }

            },

            async deleteItem(item) {

                let confirm = await Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, elimínalo\n!'
                });

                if (confirm.isConfirmed){
                    try{
                        let res = await  axios.delete(route('api.activo_tarjeta_detalles.destroy',item.id))
                        logI(res.data);

                        iziTs(res.data.message);
                        this.getDetalles();


                    }catch (e){
                        notifyErrorApi(e);
                        this.itemElimina = {};
                    }

                }

            },
            async darBajaItem(detalle) {

                let confirm = await Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, dar baja\n!'
                });

                if (confirm.isConfirmed){
                    try {

                        let res = await axios.post(route('api.activo_tarjeta_detalles.baja', detalle.id));

                        logI(res.data);

                        iziTs(res.data.message);
                        this.getDetalles();

                    } catch (e) {
                        notifyErrorApi(e);
                    }
                }

            },
            esExtra(detalle){

            }
        },
        computed: {
            dvs(){
                return @json(dvs());
            },
            tituloModal () {
                return this.editedItem.id === 0 ? 'Nuevo Detalle' : 'Editar Detalle'
            },
            textoBotonGuardar () {
                if (this.loading){
                    return this.editedItem.id === 0 ? 'Guardando...' : 'Actualizando...'

                }else {
                    return this.editedItem.id === 0 ? 'Guardar' : 'Actualizar'

                }
            },
        },
        watch: {

        }
    });
</script>
@endpush
