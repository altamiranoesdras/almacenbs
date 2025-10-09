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
                nombre: "",
                descripcion: ""
            }
        }
    },
    methods: {
        async guardar() {
            if(!this.form.nombre) {
                iziTi("El nombre es obligatorio", "warning");
                return;
            }
            if(!this.form.descripcion) {
                iziTi("La descripción es obligatoria", "warning");
                return;
            }
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
        },
        cerrarModal() {
            $("#formulario-actividades").modal('hide');
            this.$emit('cerrarModal', false);
        }
    },
    watch: {
        mostrarModal(nuevoValor) {
            if (nuevoValor) {
                this.form = this.item ? { ...this.item } : { nombre: "", descripcion: "" };
                $("#formulario-actividades").modal('show');
            }
        },

    }

}

</script>

<template>
    <div>
        <!-- Modal -->
        <div
            id="formulario-actividades"
            aria-hidden="true"
            class="modal fade"
            tabindex="-1"
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
                        <div class="mb-3">

                            <input
                                v-model="form.nombre"
                                class="form-control"
                                placeholder="Ingrese el nombre"
                                type="text"
                            />
                        </div>
                        <div class="mb-3">
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

<style scoped>
/* estilos opcionales */
</style>
