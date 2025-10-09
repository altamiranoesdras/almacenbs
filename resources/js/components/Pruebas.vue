<script>
import PruebaHijo from "./PruebaHijo.vue";

export default {
    name: "Pruebas",
    components: {
        PruebaHijo
    },
    data () {
        return {
            dataPadre: ''
        }
    },
}

</script>

<template>
    <div>
        <h1>Hola desde el padre1</h1>
        <input v-model="dataPadre" type="text">

        <div class="divider">
            aca ya no es padre
        </div>

        <PruebaHijo :datahijo="dataPadre"/>
    </div>

</template>

<style scoped>

</style>
