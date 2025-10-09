<script>
import FormularioResultado from "./FormularioProductoResultado.vue";
import FormularioProducto from "./FormularioProducto.vue";
import FormularioSubProducto from "./FormularioSubProducto.vue";

export default {
    name: "red-produccion-resultados",
    components: {
        FormularioProducto,
        FormularioResultado,
        FormularioSubProducto
    },
    data() {
        return {
            resultados: [],
            mostrarModalProductoResultado: false,
            mostrarModalProducto: false,
            mostrarModalSubProducto: false,

            resultadoSeleccionadoId: null,
            productoSeleccionadoId: null
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
            this.mostrarModalSubProducto = true;
            this.productoSeleccionadoId = productoId;
        },

        editarResultado(resultado) {
            console.log("Editar Resultado:", resultado);
        },

        async eliminarResultado(id) {
            let respuesta = await realizarPregunta("¿Estás seguro de eliminar este Resultado?");
            if (!respuesta) return;
            try {
                let res = await axios.delete(route('api.red.produccion.resultados.destroy', id));
                await this.getResultados();
                iziTs(res.data.message)
            } catch (e) {
                notifyErrorApi(e);
            }
        },

        // Producto
        editarProducto(producto) {
            console.log("Editar Producto:", producto);
        },
        async eliminarProducto(id) {
            let respuesta = await realizarPregunta("¿Estás seguro de eliminar este Producto?");
            if (!respuesta) return;
            try {
                let res = await axios.delete(route('api.red.produccion.productos.destroy', id));
                await this.getResultados();
                iziTs(res.data.message)
            } catch (e) {
                notifyErrorApi(e);
            }
        },

        // SubProducto
        editarSubProducto(subProducto) {
            console.log("Editar SubProducto:", subProducto);
        },
        async eliminarSubProducto(id) {
            let respuesta = await realizarPregunta("¿Estás seguro de eliminar este SubProducto?");
            if (!respuesta) return;
            try {
                let res = await axios.delete(route('api.red.produccion.sub-productos.destroy', id));
                await this.getResultados();
                iziTs(res.data.message)
            } catch (e) {
                notifyErrorApi(e);
            }
        },
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
                                <i class="fa fa-folder-open me-2"></i> Resultado: {{ item.codigo }}
                            </button>
                        </h2>

                        <div
                            :id="`collapse-${item.id}`"
                            :aria-labelledby="`heading-${item.id}`"
                            class="accordion-collapse collapse"
                            data-bs-parent="#accordionResultados"
                        >
                            <div class="accordion-body">

                                <!-- 🔹 Botones de acción para cada Resultado -->
                                <div class="mb-2 text-end">
                                    <button class="btn btn-sm btn-warning me-2" @click="editarResultado(item)">
                                        <i class="fa fa-edit"></i> Editar
                                    </button>
                                    <button class="btn btn-sm btn-danger" @click="eliminarResultado(item.id)">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </button>
                                </div>

                                <div class="list-group mb-2">
                                    <div
                                        v-for="producto in item.productos"
                                        :key="producto.id"
                                        class="list-group-item"
                                    >
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fa fa-cube text-success me-2"></i>
                                                <strong>Producto:</strong> {{ producto.codigo }}
                                            </div>
                                            <div>
                                                <!-- 🔹 Botones de acción para Producto -->
                                                <button class="btn btn-outline-primary btn-sm me-1" @click="agregarSubProducto(producto.id)">
                                                    <i class="fa fa-plus"></i> SubProducto
                                                </button>
                                                <button class="btn btn-sm btn-warning me-1" @click="editarProducto(producto)">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" @click="eliminarProducto(producto.id)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <ul
                                            v-if="producto.subproductos && producto.subproductos.length"
                                            class="list-group list-group-flush mt-2"
                                        >
                                            <li
                                                v-for="subProducto in producto.subproductos"
                                                :key="subProducto.id"
                                                class="list-group-item d-flex justify-content-between align-items-center"
                                            >
                                                <div>
                                                    <i class="fa fa-angle-right text-secondary me-2"></i>
                                                    <b>Subproducto:</b> {{ subProducto.codigo }}
                                                </div>
                                                <div>
                                                    <!-- 🔹 Botones de acción para SubProducto -->
                                                    <button class="btn btn-sm btn-warning me-1" @click="editarSubProducto(subProducto)">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" @click="eliminarSubProducto(subProducto.id)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <button
                                    class="btn btn-outline-primary btn-sm mt-2"
                                    @click="agregarProducto(item.id)"
                                >
                                    <i class="fa fa-plus"></i> Agregar Producto
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
        <FormularioResultado
            :mostrar-modal="mostrarModalProductoResultado"
            @registro-guardado="getResultados"
        />

        <FormularioProducto
            :mostrar-modal="mostrarModalProducto"
            :resultado-id="resultadoSeleccionadoId"
            @registro-guardado="getResultados"
        />

        <FormularioSubProducto
            :mostrar-modal="mostrarModalSubProducto"
            :producto-id="productoSeleccionadoId"
            @registro-guardado="getResultados"
        />

    </div>
</template>

<style scoped>
/* Tus estilos personalizados aquí si los necesitas */
</style>
