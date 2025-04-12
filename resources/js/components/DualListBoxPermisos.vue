<template>
    <div>

        <label for="permisos">Permisos</label>
        <a href="#" @click.prevent="newItem()" v-show="!disabled">
            Nuevo
        </a>
        <DualListBox
            :source="source"
            :destination="destination"
            :label="label"
            @onChangeList="onChangeList"
        />

        <input type="hidden" name="permisos[]" :value="rol.id" v-for="rol in destination">

        <div class="modal fade text-start" :id="id" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">Nuevo role</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form @submit.prevent="save">
                    <div class="modal-body">
                        <div class="row">


                            <!-- Nombre Field -->
                            <div class="col-sm-12 mb-1">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" @keydown.enter.prevent="save()" v-model="editedItem.name" >
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>
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
import DualListBox from "dual-listbox-vue";
import "dual-listbox-vue/dist/dual-listbox.css";
export default {
    name: "dual-listbox-permisos",
    mounted() {
        $(function (){
            $('.select-all').html('Seleccionar todos');
            $('.deselect-all').html('Ninguno');
            $('.search-box').find('input').attr('placeholder','Buscar').addClass('form-control');
        })
    },
    created() {
        this.source = this.fuente;
        this.destination = this.destino;
    },
    components: {
        DualListBox
    },
    props:{
        fuente: {
            type : Array,
            default: null,
            required: true
        },
        destino: {
            type : Array,
            default: null,
            required: true
        },
        name: {
            type: String,
            default: 'marca_id'
        },
        label:{
            type: String,
            required: true,
        },
        id:{
            type: String,
            default: 'modal_dual_list_permisos'
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
    data: function() {
        return {
            source : [],
            destination : [],

            loading: false,

            editedItem: {
                id : 0,
            },
            defaultItem: {
                id : 0,
                nombre: '',
            },
        };
    },
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

        async save () {

            this.loading = true;


            try {

                const data = this.editedItem;

                if(this.editedItem.id === 0){

                    var res = await axios.post(route('api.permissions.store'),data);

                }else {

                    var res = await axios.patch(route('api.permissions.update',this.editedItem.id),data);

                }

                logI(res.data);

                const item  = res.data.data;

                this.source.push(item)

                iziTs(res.data.message);

                this.close();

            }catch (e) {
                notifyErrorApi(e);
                this.loading = false;
            }

        },

        onChangeList: function({ source, destination }) {
            this.source = source;
            this.destination = destination;
        }
    },
    watch: {
        // fuente(val){
        //     this.source = val;
        // },
        // destino(val){
        //     this.destination = val;
        // },
    }
};
</script>

<style>

</style>
