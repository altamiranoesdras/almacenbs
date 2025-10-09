<script>
export default {
    name: "formulario-modal",
    props: {
        mostrarModal: {
            type: Boolean,
            default: false
        },
    },
    components: {
        Fields
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
        guardar() {
            console.log("Guardando...", this.form)
        }
    },
    watch: {
        mostrarModal(nuevoValor) {
            if (nuevoValor) {
                const modalElement = document.getElementById('formModal');
                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            }
        },
        form() {
            console.log(this.form)
        }
    }

}

import Fields from "./Fields.vue";
</script>

<template>
    <div>
        <!-- Modal -->
        <div
            id="formModal"
            aria-hidden="true"
            aria-labelledby="formModalLabel"
            class="modal fade"
            tabindex="-1"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="formModalLabel" class="modal-title">Nuevo Resultado</h5>
                        <button
                            aria-label="Cerrar"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            type="button"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <Fields v-model="form" />
                    </div>
                    <div class="modal-footer">
                        <button
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            type="button"
                        >
                            Cancelar
                        </button>
                        <button class="btn btn-primary" type="button" @click="guardar">
                            Guardar
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
