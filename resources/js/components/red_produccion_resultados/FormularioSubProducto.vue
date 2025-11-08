

<template>
    <div>
        <!-- Modal -->
        <div
            id="formulario-sub-producto"
            aria-hidden="true"
            class="modal fade"
            tabindex="-1"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
        >
            <div class="modal-dialog" style="max-width: 60%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="formModalLabel" class="modal-title"
                            v-text="form.id ? 'Actualizar Sub Producto' : 'Nuevo Sub Producto'">

                        </h5>
                        <button
                            aria-label="Cerrar"
                            class="btn-close"
                            @click="cerrarModal"
                            type="button"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <label class="form-label">Código</label>
                                <input
                                    v-model="form.codigo"
                                    class="form-control"
                                    placeholder="Ingrese el nombre"
                                    type="text"
                                />
                            </div>
                            <div class="col-12 mb-1">
                                <label class="form-label">Nombre</label>
                                <input
                                    v-model="form.nombre"
                                    class="form-control"
                                    placeholder="Ingrese el nombre"
                                    type="text"
                                />
                            </div>
                            <div class="col-12 mb-1">
                                <label class="form-label">Descripción</label>
                                <textarea
                                    v-model="form.descripcion"
                                    class="form-control"
                                    placeholder="Ingrese la descripción"
                                ></textarea>
                            </div>
                            <div class="col-12 mb-1">
                                <label class="form-label">RRHH Unidades</label>
                                <DualListBox
                                    :destination="form.rrhh_unidades"
                                    :source="unidades"
                                    label="text"
                                    @onChangeList="onChangeList"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            class="btn btn-secondary"
                            @click="cerrarModal"
                            type="button"
                        >
                            Cancelar
                        </button>
                        <button
                            class="btn btn-primary"
                            type="button"
                            @click="guardar"
                            v-text="form.id ? 'Actualizar' : 'Guardar'"
                        >
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DualListBox from "dual-listbox-vue";

export default {
    name: "formulario-sub-producto",
    components: {DualListBox},
    props: {
        mostrarModal: {
            type: Boolean,
            default: false
        },
        productoId: {
            type: Number,
            default: null
        },
        item: {
            type: Object,
            default: null
        }

    },
    data() {
        return {
            form: {
                codigo: "",
                nombre: "",
                descripcion: "",
                rrhh_unidades: []
            },
            unidadesOriginales: [],
            unidades: []
        }
    },
    methods: {
        async guardar() {
            esperar();
            try {
                let respuesta;
                this.form = {
                    ...this.form,
                    rrhh_unidades: this.form.rrhh_unidades.length ? this.form.rrhh_unidades.map(sp => sp.id) : []
                }
                if(this.form.id){
                    respuesta = await axios.put(route('api.red.produccion.sub-productos.update', this.form.id), this.form);
                } else {
                    respuesta = await axios.post(route('api.red.produccion.sub-productos.store'), {
                        ...this.form,
                        producto_id: this.productoId
                    });
                }

                iziTs(respuesta.data.message);
                this.cerrarModal();
                this.$emit('registro-guardado', respuesta.data.resultado);
            }
            catch (error) {
                notifyErrorApi(error);
            }
            finEspera();
        },
        async getUnidades() {
            try {
                const parametros = {
                    params: {
                        tipo_area: 1
                    }
                };

                const respuesta = await axios.get(route('api.rrhh_unidades.index'), parametros);
                this.unidadesOriginales = respuesta.data.data;
                this.unidades = respuesta.data.data;
            } catch (error) {
                notifyErrorApi(error);
            }
        },
        cerrarModal() {
            $("#formulario-sub-producto").modal('hide');
            this.$emit('cerrarModal', false);
        },
        onChangeList: function({ source, destination }) {
            this.unidades = source;
            this.form.rrhh_unidades = destination;
        }
    },
    created() {
        this.getUnidades();
    },
    watch: {
        mostrarModal(nuevoValor) {
            if (nuevoValor) {
                this.form = this.item ? { ...this.item } : { nombre: "", descripcion: "", codigo: "", rrhh_unidades: [] };
                this.form = {
                    ...this.form,
                    unidades: this.form.rrhh_unidades.length ? this.form.rrhh_unidades.map(sp => sp.id) : []
                }
                $("#formulario-sub-producto").modal('show');
            }
        },

    }

}

</script>

<style scoped>
/* estilos opcionales */
</style>
