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
            mostrarModalResultado: false,
            mostrarModalProducto: false,
            mostrarModalSubProducto: false,

            resultadoSeleccionadoId: null,
            subProgramaId: null,
            productoSeleccionadoId: null,

            resultadoSeleccionado: null,
            productoSeleccionado: null,
            subProductoSeleccionado: null,

            // 👉 control de expansión colapsado/expandido por nodo
            // guardamos claves como "R-12", "P-34"
            expanded: new Set(),
        }
    },
    mounted() {
        this.getResultados()
    },
    methods: {
        // --------- UI árbol ----------
        nodeKey(type, id) {
            return `${type}-${id}`;
        },
        isExpanded(type, id) {
            return this.expanded.has(this.nodeKey(type, id));
        },
        toggle(type, id) {
            const k = this.nodeKey(type, id);
            if (this.expanded.has(k)) this.expanded.delete(k);
            else this.expanded.add(k);
            // forzar reactividad en Set
            this.expanded = new Set(this.expanded);
        },

        // --------- Datos/CRUD ----------
        async getResultados() {
            esperar();
            try {
                const res = await axios.get(route('api.red.produccion.resultados.index'));
                this.resultados = res.data.data;
            } catch (e) {
                notifyErrorApi(e);
            }
            finEspera();
        },
        agregarResultado() {
            this.mostrarModalResultado = true;
        },
        agregarProducto(resultadoId, subProgramaId) {
            this.mostrarModalProducto = true;
            this.resultadoSeleccionadoId = resultadoId;
            this.subProgramaId = subProgramaId;
        },
        agregarSubProducto(productoId) {
            this.mostrarModalSubProducto = true;
            this.productoSeleccionadoId = productoId;
        },

        editarResultado(resultado) {
            this.resultadoSeleccionado = resultado;
            this.mostrarModalResultado = true;
        },
        async eliminarResultado(id) {
            const respuesta = await realizarPregunta("¿Estás seguro de eliminar este Resultado?");
            if (!respuesta) return;
            try {
                const res = await axios.delete(route('api.red.produccion.resultados.destroy', id));
                await this.getResultados();
                iziTs(res.data.message);
            } catch (e) {
                notifyErrorApi(e);
            }
        },

        // Producto
        editarProducto(producto, subProgramaId) {
            this.productoSeleccionado = producto;
            this.mostrarModalProducto = true;
            this.subProgramaId = subProgramaId;
        },
        async eliminarProducto(id) {
            const respuesta = await realizarPregunta("¿Estás seguro de eliminar este Producto?");
            if (!respuesta) return;
            try {
                const res = await axios.delete(route('api.red.produccion.productos.destroy', id));
                await this.getResultados();
                iziTs(res.data.message);
            } catch (e) {
                notifyErrorApi(e);
            }
        },

        editarSubProducto(subProducto) {
            this.subProductoSeleccionado = subProducto;
            this.mostrarModalSubProducto = true;
        },
        async eliminarSubProducto(id) {
            const respuesta = await realizarPregunta("¿Estás seguro de eliminar este SubProducto?");
            if (!respuesta) return;
            try {
                const res = await axios.delete(route('api.red.produccion.sub-productos.destroy', id));
                await this.getResultados();
                iziTs(res.data.message);
            } catch (e) {
                notifyErrorApi(e);
            }
        },

        // Cierres
        cerrarModalResultado() {
            this.mostrarModalResultado = false;
            this.resultadoSeleccionado = null;
        },
        cerrarFormularioProducto() {
            this.mostrarModalProducto = false;
            this.productoSeleccionado = null;
            this.subProgramaId = null;
        },
        cerrarFormularioSubProducto() {
            this.mostrarModalSubProducto = false;
            this.subProductoSeleccionado = null;
        }
    }
}
</script>

<template>
    <div>


        <!-- Árbol -->
        <ul class="tree list-unstyled">
            <li v-for="resultado in resultados" :key="resultado.id" class="tree-item">
                <div class="tree-row">
                    <button
                        class="tree-toggle btn btn-sm"
                        :aria-expanded="isExpanded('R', resultado.id)"
                        @click="toggle('R', resultado.id)"
                        :title="isExpanded('R', resultado.id) ? 'Contraer' : 'Expandir'"
                    >
                        <i :class="isExpanded('R', resultado.id) ? 'fa fa-chevron-down' : 'fa fa-chevron-right'"></i>
                    </button>

                    <i :class="isExpanded('R', resultado.id) ? 'fa fa-folder-open text-warning' : 'fa fa-folder text-warning'"></i>

                    <div class="tree-label">
                        <div class="text-truncate">
                            <span class="code">{{ resultado.codigo }}</span>
                            <span class="name">{{ resultado.nombre }}</span>
                        </div>
                        <small class="muted">Resultado</small>
                    </div>

                    <div class="tree-actions">
                        <button
                            class="btn btn-outline-success btn-sm"
                            @click="agregarProducto(resultado.id, resultado.subprograma_id)"
                            title="Agregar producto"
                        >
                            <i class="fa fa-plus"></i> Prod.
                        </button>
                        <button class="btn btn-outline-info btn-sm" @click="editarResultado(resultado)" title="Editar">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-outline-danger btn-sm" @click="eliminarResultado(resultado.id)" title="Eliminar">
                            <i class="fa fa-trash"></i>
                        </button>

                    </div>
                </div>

                <!-- Productos -->
                <transition name="tree-collapse">
                    <ul v-if="isExpanded('R', resultado.id)" class="tree children">
                        <li v-for="producto in (resultado.productos || [])" :key="producto.id" class="tree-item">
                            <div class="tree-row">
                                <button
                                    class="tree-toggle btn btn-sm"
                                    :aria-expanded="isExpanded('P', producto.id)"
                                    @click="toggle('P', producto.id)"
                                    :title="isExpanded('P', producto.id) ? 'Contraer' : 'Expandir'"
                                >
                                    <i :class="isExpanded('P', producto.id) ? 'fa fa-chevron-down' : 'fa fa-chevron-right'"></i>
                                </button>

                                <i :class="isExpanded('P', producto.id) ? 'fa fa-folder-open text-info' : 'fa fa-folder text-info'"></i>

                                <div class="tree-label">
                                    <div class="text-truncate">
                                        <span class="code">{{ producto.codigo }}</span>
                                        <span class="name">{{ producto.nombre }}</span>
                                    </div>
                                    <small class="muted">Producto</small>
                                </div>

                                <div class="tree-actions">
                                    <button class="btn btn-outline-success btn-sm" @click="agregarSubProducto(producto.id)" title="Agregar subproducto">
                                        <i class="fa fa-plus"></i> SubProd.
                                    </button>
                                    <button class="btn btn-outline-info btn-sm" @click="editarProducto(producto, resultado.subprograma_id)" title="Editar">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm" @click="eliminarProducto(producto.id)" title="Eliminar">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- SubProductos -->
                            <transition name="tree-collapse">
                                <ul v-if="isExpanded('P', producto.id)" class="tree children">
                                    <li
                                        v-for="subProducto in (producto.subproductos || [])"
                                        :key="subProducto.id"
                                        class="tree-leaf"
                                    >
                                        <div class="tree-row">
                                            <span class="tree-icon-spacer"></span>
                                            <i class="fa fa-file text-secondary"></i>

                                            <div class="tree-label">
                                                <div class="text-truncate">
                                                    <span class="code">{{ subProducto.codigo }}</span>
                                                    <span class="name">{{ subProducto.nombre }}</span>
                                                </div>
                                                <small class="muted">SubProducto</small>
                                            </div>

                                            <div class="tree-actions">
                                                <button class="btn btn-outline-info btn-sm" @click="editarSubProducto(subProducto)" title="Editar">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm" @click="eliminarSubProducto(subProducto.id)" title="Eliminar">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </transition>
                        </li>
                    </ul>
                </transition>
            </li>

        </ul>

        <div class="row">
            <div class="col ms-3 my-3">

                <button class="btn btn-success btn-sm" @click="agregarResultado">
                    <i class="fa fa-plus"></i> Nuevo Resultado
                </button>
            </div>
        </div>
        <!-- Modales -->
        <FormularioResultado
            :mostrar-modal="mostrarModalResultado"
            :item="resultadoSeleccionado"
            @registro-guardado="getResultados"
            @cerrarModal="cerrarModalResultado"
        />

        <FormularioProducto
            :mostrar-modal="mostrarModalProducto"
            :resultado-id="resultadoSeleccionadoId"
            :sub-programa-id="subProgramaId"
            :item="productoSeleccionado"
            @registro-guardado="getResultados"
            @cerrarModal="cerrarFormularioProducto"
        />

        <FormularioSubProducto
            :mostrar-modal="mostrarModalSubProducto"
            :producto-id="productoSeleccionadoId"
            :item="subProductoSeleccionado"
            @registro-guardado="getResultados"
            @cerrarModal="cerrarFormularioSubProducto"
        />
    </div>
</template>

<style scoped>
/* ====== Árbol estilo explorador ====== */
.tree {
    margin: 0;
    padding-left: 0.5rem;
}

.tree .children {
    margin-left: 1.25rem;
    border-left: 1px dashed #d9dee3; /* línea vertical */
    padding-left: 0.75rem;
}

.tree-item,
.tree-leaf {
    position: relative;
    list-style: none;
}

.tree-row {
    display: grid;
    grid-template-columns: 28px 20px 1fr auto; /* toggle | icon | label | acciones */
    gap: 0.5rem;
    align-items: center;
    padding: 0.35rem 0.5rem;
    border-radius: 8px;
}

.tree-row:hover {
    background: #f6f8fb;
}

.tree-toggle {
    width: 28px;
    height: 28px;
    line-height: 1;
    border: none;
    background: transparent;
}

.tree-toggle:focus {
    outline: 2px solid #b6d4fe;
    border-radius: 6px;
}

.tree-label {
    min-width: 0; /* habilita truncado */
}

.tree-label .code {
    font-weight: 600;
    color: #4f46e5;
    margin-right: .35rem;
    white-space: nowrap;
}

.tree-label .name {
    color: #374151;
}

.tree-label .muted {
    color: #9aa0a6;
}

.tree-actions {
    display: flex;
    gap: .4rem;
    opacity: .6;
    transition: opacity .2s ease;
}

.tree-row:hover .tree-actions {
    opacity: 1;
}

.btn-sm {
    --bs-btn-padding-y: .15rem;
    --bs-btn-padding-x: .35rem;
    --bs-btn-font-size: .75rem;
    border-radius: .35rem;
}

.tree-icon-spacer {
    width: 28px; /* ocupa el lugar del toggle en hojas */
}

/* Líneas horizontales conectando a la barra vertical */
.tree .tree-item > .tree-row::before,
.tree .tree-leaf > .tree-row::before {
    content: "";
    position: absolute;
    left: -0.75rem;
    width: 0.75rem;
    height: 1px;
    top: 50%;
    background: #d9dee3;
}

.tree .tree-item:first-child > .tree-row::before,
.tree > .tree-item > .tree-row::before {
    /* primera fila a nivel raíz no necesita línea a la izquierda */
    display: none;
}

/* Animación de colapso/expansión */
.tree-collapse-enter-active,
.tree-collapse-leave-active {
    transition: all .18s ease;
}
.tree-collapse-enter-from,
.tree-collapse-leave-to {
    opacity: 0;
    transform: translateY(-2px);
}
</style>
