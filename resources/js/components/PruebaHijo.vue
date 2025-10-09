<script>
export default {
    name: "PruebaHijo",
    props: {
        datahijo: {
            type: String,
            required: true
        }
    },
    methods: {
        notificarAlPadre() {
            // emitimos el evento personalizado con el valor que queramos
            this.$emit("enviar-al-padre", "Hola Padre, soy el hijo 😎");
        }
    },
    watch: {
        datahijo(newVal) {
            console.log("Data desde el padre ha cambiado:", newVal);
        }
    }
}
</script>

<template>
    <div>
        <h2>Prueba desde el hijo</h2>
        <p>Data desde el padre: {{ datahijo }}</p>

        <!-- 👇 Botón para emitir al padre -->
        <button @click="notificarAlPadre">Mandar data al padre</button>
    </div>
</template>
