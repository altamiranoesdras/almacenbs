<template>
    <div>
        <!-- Modal -->
        <div
            id="modalProducto"
            aria-hidden="true"
            class="modal fade"
            tabindex="-1"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
        >
            <div class="modal-dialog" style="max-width: 60%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="formModalLabel" class="modal-title" v-text="form.id ? 'Actualizar Producto' : 'Nuevo Producto'">
                        </h5>
                        <button
                            aria-label="Cerrar"
                            class="btn-close"
                            type="button"
                            @click="cerrarModal"
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
                                <label class="form-label">Actividad:</label>
<!--                                <DualListBox-->
<!--                                    :destination="form.actividades"-->
<!--                                    :source="actividades"-->
<!--                                    label="nombre"-->
<!--                                    @onChangeList="onChangeList"-->
<!--                                />-->
                                <multiselect
                                    v-model="form.actividad"
                                    :multiple="false"
                                    :options="actividades"
                                    placeholder="Seleccione una o más actividades"
                                    label="texto"
                                    track-by="id"
                                >
                                </multiselect>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            class="btn btn-secondary"
                            type="button"
                            @click="cerrarModal"
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
    name: "modal-producto",
    components: {DualListBox},
    props: {
        mostrarModal: {
            type: Boolean,
            default: false
        },
        resultadoId: {
            type: Number,
            default: null
        },
        subProgramaId: {
            type: Number,
            default: null
        },
        item: {
            type: Object,
            default: () => ({}),
            required: false
        }
    },
    data() {
        return {
            form: {
                codigo: "",
                nombre: "",
                descripcion: "",
                actividad: []
            },
            actividadesOriginales: [],
            actividades: []
        }
    },
    methods: {
        async guardar() {
            esperar();
            try {
                let respuesta;
                this.form = {
                    ...this.form,
                    actividad_id: this.form?.actividad?.id
                }
                if(this.form.id){
                    respuesta = await axios.put(route('api.red.produccion.productos.update', this.form.id), this.form);
                } else {
                    respuesta = await axios.post(route('api.red.produccion.productos.store'), {
                        ...this.form,
                        resultado_id: this.resultadoId
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
        async getActividades() {
            console.log('Obteniendo actividades para el subprograma ID:', this.subProgramaId);
            try {
                const respuesta = await axios.get(route('api.estructura.presupuestaria.actividades.index', { subprograma_id: this.subProgramaId ?? -1 }));
                this.actividades = respuesta.data.data;
                this.actividadesOriginales = respuesta.data.data;
            } catch (error) {
                notifyErrorApi(error);
            }
        },
        cerrarModal() {
            $("#modalProducto").modal('hide');
            this.$emit('cerrarModal', false);
        },
        // onChangeList: function({ source, destination }) {
        //     this.actividades = source;
        //     this.form.actividades = destination;
        // }
    },
    created() {
        // this.getActividades();
    },
    watch: {
        mostrarModal(nuevoValor) {
            if (nuevoValor) {
                this.getActividades()
                this.form = this.item ? { ...this.item } : { nombre: "", descripcion: "", codigo: "", actividad: null };
                // if (this.form.actividades.length) {
                //     this.actividades = this.actividades.filter(sp => !this.form.actividades.some(fsp => fsp.id === sp.id));
                // } else {
                //     this.actividades = [...this.actividadesOriginales];
                // }
                $("#modalProducto").modal('show');
            }
        },
    }

}

</script>

<style scoped>
/* estilos opcionales */
</style>
