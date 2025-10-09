<script>
export default {
    name: "formulario-sub-producto",
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
        },
        cerrarModal() {
            $("#formulario-sub-producto").modal('hide');
            this.$emit('update:mostrarModal', false);
        }
    },
    watch: {
        mostrarModal(nuevoValor) {
            if (nuevoValor) {
                this.form = this.item ? { ...this.item } : { nombre: "", descripcion: "" };
                $("#formulario-sub-producto").modal('show');
            }
        },

    }

}

</script>

<template>
    <div>
        <!-- Modal -->
        <div
            id="formulario-sub-producto"
            aria-hidden="true"
            class="modal fade"
            tabindex="-1"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="formModalLabel" class="modal-title">Nuevo SubProducto</h5>
                        <button
                            aria-label="Cerrar"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            type="button"
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
                            data-bs-dismiss="modal"
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

<style scoped>
/* estilos opcionales */
</style>
