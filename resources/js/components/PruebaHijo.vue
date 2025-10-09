<script>

export default {
    name: "PruebaHijo",
    props: {
        datahijo: {
            type: String,
            required: true
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
    </div>

</template>

<style scoped>

</style>
