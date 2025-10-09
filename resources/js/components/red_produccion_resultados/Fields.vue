<script>

export default {
    name: "Fields",
    props: {
        value: {
            default: null,
            required: true
        },
    },
    data() {
        return {
            form: {
                nombre: "",
                descripcion: ""
            }
        }
    },
    // watch: {
    //     'form.nombre'(nuevoValor) {
    //         this.$emit('input', nuevoValor);
    //     },
    //     'form.descripcion'(nuevoValor) {
    //         this.$emit('input', nuevoValor);
    //     }
    // }

}

</script>

<template>
    <form>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
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
    </form>

</template>

<style scoped>

</style>
