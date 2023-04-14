<template>
    <div>
        <h1 class="text-center text-2xl my-2">{{ title }}</h1>
        <p v-if="isAuthenticated">Вы вошли в систему как {{ user.name }}</p>
        <button @click="onLogout">Выйти</button>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "Index",
    props: {
        title: String,
        user: Object
    },
    computed: {
        ...mapGetters(['isAuthenticated', 'user']),
    },
    methods: {
        ...mapActions(['logout']),
        onLogout() {
            this.logout().then(resp => {
                this.$inertia.visit('/login')
            }).catch(e => {
                this.$inertia.visit('/login')
                console.error(e);
                throw e
            })
        },
    },
}
</script>

<style scoped>

</style>
