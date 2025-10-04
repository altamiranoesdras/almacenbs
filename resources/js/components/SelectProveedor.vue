<template>
    <div>
        <label v-text="label+':'"></label>
        <span class="text-danger" v-show="required">*</span>


        <a href="#" v-if="!item" @click.prevent="newItem()" v-show="!disabled">
            Nuevo
        </a>

        <a href="#" v-if="item" @click.prevent="editItem(item)" v-show="!disabled">
            editar
        </a>

        <multiselect v-model="item" :options="options" label="texto" placeholder="Seleccione uno..." :disabled="disabled">
            <template  slot="noResult">
                <a class="btn btn-sm btn-block btn-success" href="#" @click.prevent="newItem()">
                    <i class="fa fa-plus"></i> Nuevo
                </a>
            </template >
        </multiselect>


        <input type="hidden" :name="name" :value="getId(item)">


        <div class="modal fade" :id="id" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelTitleId">
                            <span v-text="formTitle"></span>
                        </h4>
                        <!-- Botón de cierre actualizado -->
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form @submit.prevent="save">
                        <div class="modal-body">
                            <div class="row">
                                <!-- Nit (Requerido) -->
                                <div class="col-4 mb-1">
                                    <label for="nit" class="form-label">
                                        Nit:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        id="nit"
                                        type="text"
                                        class="form-control"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.nit"
                                        autocomplete="off"
                                    >
                                </div>

                                <!-- Nombre (Requerido) -->
                                <div class="col-4 mb-1">
                                    <label for="nombre" class="form-label">
                                        Nombre:
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        id="nombre"
                                        type="text"
                                        class="form-control"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.nombre"
                                        autocomplete="name"
                                    >
                                </div>

                                <!-- Razón Social (Opcional) -->
                                <div class="col-4 mb-1">
                                    <label for="razon_social" class="form-label">Razón Social:</label>
                                    <input
                                        id="razon_social"
                                        type="text"
                                        class="form-control"
                                        placeholder="Opcional"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.razon_social"
                                        autocomplete="organization"
                                    >
                                </div>

                                <!-- Correo (Opcional) -->
                                <div class="col-4 mb-1">
                                    <label for="correo" class="form-label">Correo:</label>
                                    <input
                                        id="correo"
                                        type="email"
                                        class="form-control"
                                        placeholder="Opcional"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.correo"
                                        autocomplete="email"
                                        inputmode="email"
                                    >
                                </div>

                                <!-- Teléfono Móvil (Opcional) -->
                                <div class="col-4 mb-1">
                                    <label for="telefono_movil" class="form-label">Teléfono Móvil:</label>
                                    <input
                                        id="telefono_movil"
                                        type="tel"
                                        class="form-control"
                                        placeholder="Opcional"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.telefono_movil"
                                        autocomplete="tel-national"
                                        inputmode="tel"
                                    >
                                </div>

                                <!-- Teléfono Oficina (Opcional) -->
                                <div class="col-4 mb-1">
                                    <label for="telefono_oficina" class="form-label">Teléfono Oficina:</label>
                                    <input
                                        id="telefono_oficina"
                                        type="tel"
                                        class="form-control"
                                        placeholder="Opcional"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.telefono_oficina"
                                        autocomplete="tel"
                                        inputmode="tel"
                                    >
                                </div>

                                <!-- Dirección (Opcional) -->
                                <div class="col-12 mb-1">
                                    <label for="direccion" class="form-label">Dirección:</label>
                                    <textarea
                                        id="direccion"
                                        class="form-control"
                                        placeholder="Opcional"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.direccion"
                                        rows="2"
                                        autocomplete="street-address"
                                    ></textarea>
                                </div>

                                <!-- Observaciones (Opcional) -->
                                <div class="col-12 mb-1">
                                    <label for="observaciones" class="form-label">Observaciones:</label>
                                    <textarea
                                        id="observaciones"
                                        class="form-control"
                                        placeholder="Opcional"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.observaciones"
                                        rows="2"
                                    ></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <!-- data-bs-dismiss en lugar de data-dismiss -->
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">
                                <span v-text="loading ? 'GUARDANDO...' : 'GUARDAR'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

export default {

    name: 'select-proveedor',
    created() {
        this.item = this.value;
        this.getItems();

    },
    props:{
        value: {
            default: null,
            required: true
        },
        items:{
            type: Array,
            default() {
                return [];
            },
            required: false,
        },

        name: {
            type: String,
            default: 'proveedor_id'
        },
        label:{
            type: String,
            required: true,
        },
        id:{
            type: String,
            default: 'modal_select_proveedor'
        },
        disabled:{
            type: Boolean,
            default: false
        },
        required:{
            type: Boolean,
            default: true
        }
    },

    data: () => ({
        loading: false,

        item: null,
        items_api: [],
        editedItem: {
            id : 0,
        },
        defaultItem: {
            id : 0,
            nombre: '',
        },
    }),
    methods: {
        getId(item){
            if(item)
                return item.id;

            return null
        },
        newItem () {
            $("#"+this.id).modal('show');
            this.editedItem = Object.assign({}, this.defaultItem);
        },
        editItem (item) {
            $("#"+this.id).modal('show');
            this.editedItem = Object.assign({}, item);

        },
        close () {
            $("#"+this.id).modal('hide');
            this.loading = false;
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
            }, 300)
        },

        async getItems () {

            try {

                var res = await axios.get(route('api.proveedores.index'));

                this.items_api  = res.data.data;

            }catch (e) {
                notifyErrorApi(e);
            }

        },
        async save () {

            this.loading = true;


            try {

                const data = this.editedItem;

                if(this.editedItem.id === 0){

                    var res = await axios.post(route('api.proveedores.store'),data);

                }else {

                    var res = await axios.patch(route('api.proveedores.update',this.editedItem.id),data);

                }

                logI(res.data);

                const item  = res.data.data;

                this.actualizaSelect(item);

                iziTs(res.data.message);

                this.close();

            }catch (e) {
                notifyErrorApi(e);
                this.loading = false;
            }

        },
        actualizaSelect(item){


            if (this.items.length > 0){
                if (this.editedItem.id==0){
                    this.items.push(item);
                }else {

                    var index = this.items.findIndex(o => o.id == item.id);
                    //remplaza item actualizado
                    this.items.splice(index, 1,item);

                }
            }else {
                if (this.editedItem.id==0){
                    this.items_api.push(item);
                }else {

                    var index = this.items_api.findIndex(o => o.id == item.id);
                    //remplaza item actualizado
                    this.items_api.splice(index, 1,item);

                }
            }


            //Cambia el item seleccionado
            this.item = item;


        }
    },
    computed: {
        formTitle () {
            return this.editedItem.id === 0 ? 'Nuevo '+ this.label : 'Editar '+ this.label
        },
        options(){
            if (this.items.length > 0){
                return this.items
            }else {
                return this.items_api;
            }
        }

    },
    watch: {
        item (val) {
            this.$emit('input', val);
        },
        value(val){
            this.item = val;
        }
    }

}
</script>



