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
    methods: {
        recibirDelHijo(valor) {
            console.log("Recibido desde el hijo:", valor);
            this.dataPadre = valor;
        }
    }
}
</script>

<template>
    <div>
        <h1>Hola desde el padre</h1>
        <input v-model="dataPadre" type="text">

        <div class="divider">aca ya no es padre</div>

        <!-- 👇 Escuchamos el evento personalizado -->
        <PruebaHijo :datahijo="dataPadre" @enviar-al-padre="recibirDelHijo"/>
    </div>
</template>
