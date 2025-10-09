<script>
import ModalNuevoProductoResultado from "./FormularioProductoResultado.vue";
import ModalProducto from "./FormularioProducto.vue";

export default {
    name: "red-produccion-resultados",
    components: {
        ModalProducto,
        ModalNuevoProductoResultado
    },
    data() {
        return {
            resultados: [],
            mostrarModalProductoResultado: false,
            mostrarModalProducto: false,

            resultadoSeleccionadoId: null
        }
    },
    mounted() {
        this.getResultados()
    },
    methods: {
        async getResultados() {
            try {
                var res = await axios.get(route('api.red.produccion.resultados.index'));
                this.resultados = res.data.data;
            } catch (e) {
                notifyErrorApi(e);
            }
        },
        agregarResultado() {
            this.mostrarModalProductoResultado = true;
        },
        agregarProducto(resultadoId) {
            this.mostrarModalProducto = true;
            this.resultadoSeleccionadoId = resultadoId;
        },
        agregarSubProducto(productoId) {
            // lógica para agregar subproducto a un producto
        }
    }
}
</script>

<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div id="accordionResultados" class="accordion">
                    <div
                        v-for="item in resultados"
                        :key="item.id"
                        class="accordion-item mb-2 shadow-sm rounded"
                    >
                        <h2 :id="`heading-${item.id}`" class="accordion-header">
                            <button
                                :aria-controls="`collapse-${item.id}`"
                                :data-bs-target="`#collapse-${item.id}`"
                                aria-expanded="false"
                                class="accordion-button collapsed fw-bold text-primary"
                                data-bs-toggle="collapse"
                                type="button"
                            >
                                <i class="fa fa-folder-open me-2"></i> Resultado:
                                {{ item.codigo }}
                            </button>
                        </h2>

                        <div
                            :id="`collapse-${item.id}`"
                            :aria-labelledby="`heading-${item.id}`"
                            class="accordion-collapse collapse"
                            data-bs-parent="#accordionResultados"
                        >
                            <div class="accordion-body">
                                <div class="list-group mb-2">
                                    <div
                                        v-for="producto in item.productos"
                                        :key="producto.id"
                                        class="list-group-item"
                                    >
                                        <div
                                            class="d-flex justify-content-between align-items-center"
                                        >
                                            <div>
                                                <i class="fa fa-cube text-success me-2"></i>
                                                <strong>Producto:</strong> {{ producto.codigo }}
                                            </div>
                                            <button
                                                class="btn btn-outline-primary btn-sm"
                                                @click="agregarSubProducto(producto.id)"
                                            >
                                                <i class="fa fa-plus"></i> Agregar SubProducto
                                            </button>
                                        </div>

                                        <ul
                                            v-if="producto.subproductos && producto.subproductos.length"
                                            class="list-group list-group-flush mt-2"
                                        >
                                            <li
                                                v-for="subProducto in producto.subproductos"
                                                :key="subProducto.id"
                                                class="list-group-item"
                                            >
                                                <i class="fa fa-angle-right text-secondary me-2"></i>
                                                <b>Subproducto:</b> {{ subProducto.codigo }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <button
                                    class="btn btn-outline-primary btn-sm mt-2"
                                    @click="agregarProducto(item.id)"
                                >
                                    <i class="fa fa-plus"></i> Agregar Producto1
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 text-end">
                    <button class="btn btn-outline-success" @click="agregarResultado">
                        <i class="fa fa-plus"></i> Nuevo Resultado
                    </button>
                </div>
            </div>
        </div>
        <ModalNuevoProductoResultado
            :mostrar-modal="mostrarModalProductoResultado"
            @registro-guardado="getResultados"
        />

        <ModalProducto
            :mostrar-modal="mostrarModalProducto"
            :resultado-id="resultadoSeleccionadoId"
            @registro-guardado="getResultados"
        />

    </div>
</template>

<style scoped>
/* Tus estilos personalizados aquí si los necesitas */
</style>
