<template>
    <div>
        <label v-text="label+':'"></label>
        <span class="text-danger" v-show="required">*</span>
<!--        <a href="#" v-if="item" @click.prevent="editItem(item)" v-show="!disabled">-->
<!--            editar-->
<!--        </a>-->

        <multiselect v-model="item" :options="options" label="nombre_completo" placeholder="Seleccione uno..." :disabled="disabled">
            <template  slot="noResult">
                <a class="btn btn-sm btn-block btn-success" href="#" @click.prevent="newItem()">
                    <i class="fa fa-plus"></i> Nuevo
                </a>
            </template >
        </multiselect>

        <input type="hidden" :name="name" :value="getId(item)">

        <div class="modal fade" :id="id" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
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
                                <!-- Nombres Field -->
                                <div class="col-sm-6 mb-3">
                                    <label for="nombres" class="form-label">Nombres:</label>
                                    <input type="text" class="form-control"
                                        id="nombres"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.nombres">
                                </div>

                                <!-- Apellidos Field -->
                                <div class="col-sm-6 mb-3">
                                    <label for="apellidos" class="form-label">Apellidos:</label>
                                    <input type="text" class="form-control"
                                        id="apellidos"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.apellidos">
                                </div>

                                <!-- DPI Field -->
                                <div class="col-sm-6 mb-3">
                                    <label for="dpi" class="form-label">DPI:</label>
                                    <input type="text" class="form-control"
                                        id="dpi"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.dpi">
                                </div>

                                <!-- Correo Field -->
                                <div class="col-sm-6 mb-3">
                                    <label for="correo" class="form-label">Correo:</label>
                                    <input type="text" class="form-control"
                                        id="correo"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.correo">
                                </div>

                                <!-- Teléfono Field -->
                                <div class="col-sm-6 mb-3">
                                    <label for="telefono" class="form-label">Teléfono:</label>
                                    <input type="text" class="form-control"
                                        id="telefono"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.telefono">
                                </div>

                                <!-- Dirección Field -->
                                <div class="col-sm-6 mb-3">
                                    <label for="direccion" class="form-label">Dirección:</label>
                                    <input type="text" class="form-control"
                                        id="direccion"
                                        @keydown.enter.prevent="save()"
                                        v-model="editedItem.direccion">
                                </div>

                                <!-- Nit Field -->
                                <div class="col-12 mb-3">
                                    <label for="nit" class="form-label">Nit:</label>
                                    <textarea class="form-control"
                                            id="nit"
                                            @keydown.enter.prevent="save()"
                                            v-model="editedItem.nit"></textarea>
                                </div>

                                <!-- Observaciones Field -->
                                <div class="col-12 mb-3">
                                    <label for="observaciones" class="form-label">Observaciones:</label>
                                    <textarea class="form-control"
                                            id="observaciones"
                                            @keydown.enter.prevent="save()"
                                            v-model="editedItem.observaciones"></textarea>
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
    name: 'select-colaborador',
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
            default: 'colaborador_id'
        },
        label:{
            type: String,
            required: true,
        },
        id:{
            type: String,
            default: 'modal_select_colaborador'
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
        getId(item) {
            if (item)
                return item.id;

            return null
        },
        newItem() {
            $("#" + this.id).modal('show');
            this.editedItem = Object.assign({}, this.defaultItem);
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
        async getItems () {

            try {

                var res = await axios.get(route('api.colaboradores.index'));

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

                    var res = await axios.post(route('api.colaboradores.store'),data);

                }else {

                    var res = await axios.patch(route('api.colaboradores.update',this.editedItem.id),data);

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

<style scoped>

</style>
