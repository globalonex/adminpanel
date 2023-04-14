<template>

    <Header/>

    <slot/>

</template>

<script>
import Header from "./Header.vue";

export default {
    name: "AuthLayout",
    components: {Header}
}
</script>

<style scoped>

</style>
