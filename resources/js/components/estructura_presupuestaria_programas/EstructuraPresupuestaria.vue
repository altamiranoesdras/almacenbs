<script>
import FormularioPrograma from "./FormularioPrograma.vue";
import FormularioSubPrograma from "./FormularioSubPrograma.vue";
import FormularioProyecto from "./FormularioProyecto.vue";
import FormularioActividad from "./FormularioActividad.vue";

export default {
    name: "red-produccion-resultados",
    components: {
        FormularioPrograma,
        FormularioSubPrograma,
        FormularioProyecto,
        FormularioActividad,
    },
    data() {
        return {
            resultados: [],
            mostrarFormularioPrograma: false,
            mostrarFormularioSubPrograma: false,
            mostrarFormularioProyecto: false,
            mostrarFormularioActividad: false,

            programaSeleccionadoId: null,
            subProgramaSeleccionadoId: null,
            proyectoSeleccionadoId: null,

            programaSeleccionado: null,
            subProgramaSeleccionado: null,
            proyectoSeleccionado: null,
            actividadSeleccionada: null,
        }
    },
    mounted() {
        this.getResultados()
    },
    methods: {
        async getResultados() {
            try {
                var res = await axios.get(route('api.estructura.presupuestaria.programas.index'));
                this.resultados = res.data.data;
                console.log(this.resultados)
            } catch (e) {
                notifyErrorApi(e);
            }
        },

        //Programa
        agregarPrograma() {
            this.mostrarFormularioPrograma = true;
        },
        editarPrograma(resultado) {
            this.programaSeleccionado = resultado;
            this.mostrarFormularioPrograma = true;
        },
        async eliminarPrograma(id) {
            let respuesta = await realizarPregunta("¿Estás seguro de eliminar este Programa?");
            if (!respuesta) return;
            esperar();
            try {
                let res = await axios.delete(route('api.estructura.presupuestaria.programas.destroy', id));
                await this.getResultados();
                iziTs(res.data.message)
            } catch (e) {
                notifyErrorApi(e);
            }
            finEspera();
        },

        // SubPrograma
        agregarSubPrograma(resultadoId) {
            this.mostrarFormularioSubPrograma = true;
            this.programaSeleccionadoId = resultadoId;
        },
        editarSubPrograma(producto) {
            this.subProgramaSeleccionado = producto;
            this.mostrarFormularioSubPrograma = true;
        },
        async eliminarSubPrograma(id) {
            let respuesta = await realizarPregunta("¿Estás seguro de eliminar este SubPrograma?");
            if (!respuesta) return;
            esperar();
            try {
                let res = await axios.delete(route('api.estructura.presupuestaria.subprogramas.destroy', id));
                await this.getResultados();
                iziTs(res.data.message)
            } catch (e) {
                notifyErrorApi(e);
            }
            finEspera();
        },

        // Proyecto
        agregarProyecto(subProgramaId) {
            this.mostrarFormularioProyecto = true;
            this.subProgramaSeleccionadoId = subProgramaId;
        },
        editarProyecto(subProducto) {
            this.proyectoSeleccionado = subProducto;
            this.mostrarFormularioProyecto = true;
        },
        async eliminarProyecto(id) {
            let respuesta = await realizarPregunta("¿Estás seguro de eliminar este Proyecto?");
            if (!respuesta) return;
            esperar();
            try {
                let res = await axios.delete(route('api.estructura.presupuestaria.proyectos.destroy', id));
                await this.getResultados();
                iziTs(res.data.message)
            } catch (e) {
                notifyErrorApi(e);
            }
            finEspera();
        },

        //Actividad
        agregarActividad(proyectoId) {
            this.mostrarFormularioActividad = true;
            this.proyectoSeleccionadoId = proyectoId;
        },
        editarActividad(actividad) {
            this.actividadSeleccionada = actividad;
            this.mostrarFormularioActividad = true;
        },
        async eliminarActividad(id) {
            let respuesta = await realizarPregunta("¿Estás seguro de eliminar esta Actividad?");
            if (!respuesta) return;
            esperar();
            try {
                let res = await axios.delete(route('api.estructura.presupuestaria.actividades.destroy', id));
                await this.getResultados();
                iziTs(res.data.message)
            } catch (e) {
                notifyErrorApi(e);
            }
            finEspera();
        },


        cerrarModalPrograma() {
            this.mostrarFormularioPrograma = false;
            this.programaSeleccionado = null;
        },
        cerrarModalSubPrograma() {
            this.mostrarFormularioSubPrograma = false;
            this.subProgramaSeleccionado = null;
        },
        cerrarModalProyecto() {
            this.mostrarFormularioProyecto = false;
            this.proyectoSeleccionado = null;
        },
        cerrarModalActividad() {
            this.mostrarFormularioActividad = false;
            this.actividadSeleccionada = null;
        }

    }
}
</script>

<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="text-end mb-2">
                    <button class="btn btn-outline-success" @click="agregarPrograma">
                        <i class="fa fa-plus"></i> Nuevo Programa
                    </button>
                </div>
                <div id="accordionResultados" class="accordion">
                    <div
                        v-for="item in resultados"
                        :key="item.id"
                        class="accordion-item mb-2 shadow-sm rounded"
                    >
                        <!-- 🔹 Resultado -->
                        <h2 :id="`heading-${item.id}`" class="accordion-header">
                            <button
                                class="accordion-button collapsed fw-bold text-primary"
                                type="button"
                                :aria-controls="`collapse-${item.id}`"
                                :data-bs-target="`#collapse-${item.id}`"
                                aria-expanded="false"
                                data-bs-toggle="collapse"
                            >
                                <i class="fa fa-folder-open me-2"></i>
                                <strong>Programa: </strong> {{ item.codigo }} - {{ item.nombre }}
                                <span v-if="item.sub_programas && item.sub_programas.length"
                                      class="badge bg-secondary ms-2"
                                >
                                    {{ item.sub_programas.length }} subprogramas
                                </span>
                            </button>
                        </h2>

                        <div
                            class="accordion-collapse collapse"
                            :id="`collapse-${item.id}`"
                            :aria-labelledby="`heading-${item.id}`"
                            data-bs-parent="#accordionResultados"
                        >
                            <div class="accordion-body">

                                <!-- Acciones Resultado -->
                                <div class="mb-3 d-flex justify-content-end gap-2">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-warning" @click="editarPrograma(item)">
                                            <i class="fa fa-edit"></i> Editar
                                        </button>
                                        <button class="btn btn-danger" @click="eliminarPrograma(item.id)">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </div>
                                </div>

                                <!-- SubProgramas -->
                                <div class="list-group mb-2">
                                    <div
                                        v-for="subPrograma in item.sub_programas"
                                        :key="subPrograma.id"
                                        class="list-group-item"
                                    >
                                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                                            <div class="me-2">
                                                <i class="fa fa-cube text-success me-2"></i>
                                                <strong>{{ subPrograma.codigo }}</strong> - {{ subPrograma.nombre }}
                                                <span v-if="subPrograma.proyectos && subPrograma.proyectos.length"
                                                      class="badge bg-light text-dark ms-2"
                                                >
                                                    {{ subPrograma.proyectos.length }} proyectos
                                                </span>
                                            </div>
                                            <div class="btn-group btn-group-sm mt-2 mt-sm-0">
                                                <button class="btn btn-outline-primary"
                                                        @click="agregarProyecto(subPrograma.id)">
                                                    <i class="fa fa-plus"></i> Proyecto
                                                </button>
                                                <button class="btn btn-warning" @click="editarSubPrograma(subPrograma)">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger"
                                                        @click="eliminarSubPrograma(subPrograma.id)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Proyectos -->
                                        <ul
                                            v-if="subPrograma.proyectos && subPrograma.proyectos.length"
                                            class="list-group list-group-flush mt-2 border-start ps-3"
                                        >
                                            <li
                                                v-for="proyecto in subPrograma.proyectos"
                                                :key="proyecto.id"
                                                class="list-group-item"
                                            >
                                                <div class="d-flex justify-content-between align-items-start flex-wrap">
                                                    <div class="me-2">
                                                        <i class="fa fa-angle-right text-secondary me-2"></i>
                                                        <b>{{ proyecto.codigo }}</b> - {{ proyecto.nombre }}
                                                        <span v-if="proyecto.actividades && proyecto.actividades.length"
                                                              class="badge bg-secondary text-dark ms-2">
                      {{ proyecto.actividades.length }} actividades
                    </span>
                                                    </div>
                                                    <div class="btn-group btn-group-sm mt-2 mt-sm-0">
                                                        <!-- Toggle actividades (collapse por proyecto) -->
                                                        <button
                                                            :aria-controls="`acts-${proyecto.id}`"
                                                            :data-bs-target="`#acts-${proyecto.id}`"
                                                            class="btn btn-outline-secondary"
                                                            data-bs-toggle="collapse"
                                                            type="button"
                                                        >
                                                            <i class="fa fa-list-ul"></i> Ver actividades
                                                        </button>
                                                        <button class="btn btn-outline-primary"
                                                                @click="agregarActividad(proyecto.id)">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                        <button class="btn btn-warning"
                                                                @click="editarProyecto(proyecto)">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger"
                                                                @click="eliminarProyecto(proyecto.id)">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Actividades (collapse) -->
                                                <div
                                                    :id="`acts-${proyecto.id}`"
                                                    class="collapse mt-2"
                                                >
                                                    <ul class="list-group list-group-flush ms-3">
                                                        <li
                                                            v-for="actividad in (proyecto.actividades || [])"
                                                            :key="actividad.id"
                                                            class="list-group-item d-flex justify-content-between align-items-center"
                                                        >
                                                            <div>
                                                                <i class="fa fa-check-circle text-info me-2"></i>
                                                                <b>{{ actividad.codigo }}</b> -
                                                                {{ actividad.nombre }}
                                                            </div>
                                                            <div class="btn-group btn-group-sm">
                                                                <button class="btn btn-warning"
                                                                        @click="editarActividad(actividad)">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-danger"
                                                                        @click="eliminarActividad(actividad.id)">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </li>

                                                        <!-- Empty state -->
                                                        <li
                                                            v-if="!(proyecto.actividades && proyecto.actividades.length)"
                                                            class="list-group-item text-muted fst-italic"
                                                        >
                                                            No hay actividades registradas.
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>

                                        <!-- Empty state de Proyectos -->
                                        <div
                                            v-else
                                            class="text-muted small fst-italic mt-2"
                                        >
                                            Este subprograma aún no tiene proyectos.
                                        </div>
                                    </div>
                                </div>

                                <button
                                    class="btn btn-outline-primary btn-sm mt-2"
                                    @click="agregarSubPrograma(item.id)"
                                >
                                    <i class="fa fa-plus"></i> Agregar SubPrograma
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
                <FormularioPrograma
                    :item="programaSeleccionado"
                    :mostrar-modal="mostrarFormularioPrograma"
                    @cerrarModal="cerrarModalPrograma"
                    @registro-guardado="getResultados"
                />

                <FormularioSubPrograma
                    :item="subProgramaSeleccionado"
                    :mostrar-modal="mostrarFormularioSubPrograma"
                    :programa-id="programaSeleccionadoId"
                    @cerrarModal="cerrarModalSubPrograma"
                    @registro-guardado="getResultados"
                />

                <FormularioProyecto
                    :item="proyectoSeleccionado"
                    :mostrar-modal="mostrarFormularioProyecto"
                    :sub-programa-id="subProgramaSeleccionadoId"
                    @cerrarModal="cerrarModalProyecto"
                    @registro-guardado="getResultados"
                />

                <FormularioActividad
                    :item="actividadSeleccionada"
                    :mostrar-modal="mostrarFormularioActividad"
                    :proyecto-id="proyectoSeleccionadoId"
                    @cerrarModal="cerrarModalActividad"
                    @registro-guardado="getResultados"
                />

    </div>
</template>

<style scoped>
/* Tus estilos personalizados aquí si los necesitas */
</style>
