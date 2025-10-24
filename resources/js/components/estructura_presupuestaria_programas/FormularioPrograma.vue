<script>
export default {
    name: "formulario-programa",
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
                    respuesta = await axios.put(route('api.estructura.presupuestaria.programas.update', this.form.id), this.form);
                } else {
                    respuesta = await axios.post(route('api.estructura.presupuestaria.programas.store'), this.form);
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
            $("#formulario-programa").modal('hide');
            this.$emit('cerrarModal', false);
        }
    },
    watch: {
        mostrarModal(nuevoValor) {
            if (nuevoValor) {
                this.form = this.item ? { ...this.item } : { nombre: "", descripcion: "" };
                $("#formulario-programa").modal('show');
            }
        },

    }

}

</script>

<template>
    <div>
        <!-- Modal -->
        <div
            id="formulario-programa"
            aria-hidden="true"
            class="modal fade"
            tabindex="-1"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="formModalLabel" class="modal-title">Nuevo Programa</h5>
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
