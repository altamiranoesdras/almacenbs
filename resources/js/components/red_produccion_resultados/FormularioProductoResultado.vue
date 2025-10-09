

<template>
    <div>
        <!-- Modal -->
        <div
            id="formulario-producto-resuelto"
            class="modal fade"
            tabindex="-1"
            aria-hidden="true"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
        >
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="formModalLabel" class="modal-title">Nuevo Resultado</h5>
                        <button
                            aria-label="Cerrar"
                            class="btn-close"
                            type="button"
                            @click="cerrarModal()"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <label class="form-label">Código</label>
                                <input
                                    v-model="form.codigo"
                                    class="form-control"
                                    placeholder="Ingrese el código"
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
                    </div>
                    <div class="modal-footer">
                        <button
                            class="btn btn-secondary"
                            type="button"
                            @click="cerrarModal()"
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
    name: "formulario-modal",
    props: {
        mostrarModal: {
            type: Boolean,
            default: false
        },
        item: {
            type: Object,
            default: null,
            required: false
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
    onMounted() {
        this.form = this.item
    },
    methods: {
        async guardar() {
            esperar();
            try {
                let respuesta;
                if (this.form.id) {
                    respuesta = await axios.put(route('api.red.produccion.resultados.update', this.form.id), this.form);
                } else{
                    respuesta = await axios.post(route('api.red.produccion.resultados.store'), this.form);
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
            $("#formulario-producto-resuelto").modal('hide');
            this.$emit('cerrarModal', false);
        },

    },
    watch: {
        mostrarModal(nuevoValor) {
            if (nuevoValor) {
                this.form = this.item ? { ...this.item } : { nombre: "", descripcion: "" };
                $("#formulario-producto-resuelto").modal('show');
            }
        },

    }
}

</script>

<style scoped>
/* estilos opcionales */
</style>

