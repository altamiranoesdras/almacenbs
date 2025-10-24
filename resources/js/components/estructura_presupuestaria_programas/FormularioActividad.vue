<template>
    <div>
        <!-- Modal -->
        <div
            id="formulario-actividades"
            aria-hidden="true"
            class="modal fade"
            tabindex="-1"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="formModalLabel" class="modal-title">Nueva Actividad</h5>
                        <button
                            aria-label="Cerrar"
                            class="btn-close"
                            type="button"
                            @click="cerrarModal"
                        ></button>
                    </div>
                    <div class="modal-body">
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
export default {
    name: "formulario-programa",
    props: {
        mostrarModal: {
            type: Boolean,
            default: false
        },
        proyectoId: {
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
                descripcion: ""
            }
        }
    },
    methods: {
        async guardar() {
            esperar();
            try {
                let respuesta;
                if(this.form.id){
                    respuesta = await axios.put(route('api.estructura.presupuestaria.actividades.update', this.form.id), this.form);
                } else {
                    respuesta = await axios.post(route('api.estructura.presupuestaria.actividades.store'), {
                        ...this.form,
                        proyecto_id: this.proyectoId
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
        cerrarModal() {
            $("#formulario-actividades").modal('hide');
            this.$emit('cerrarModal', false);
        }
    },
    watch: {
        mostrarModal(nuevoValor) {
            if (nuevoValor) {
                this.form = this.item ? { ...this.item } : { codigo: "", nombre: "", descripcion: "" };
                $("#formulario-actividades").modal('show');
            }
        },

    }

}

</script>

<style scoped>
/* estilos opcionales */
</style>
