<template>
    <button @click="onLogout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white w-full text-left">{{ title ?? "Выйти" }}</button>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import http from "../../components/scripts/http/axios";

export default {
    name: "ExitButton",
    props: {
        title: String,
        classes: {
            type: String,
            default: ''
        },
        user: Object
    },

    methods: {
        ...mapActions(['logout']),
        async onLogout() {
            try {
                this.logout().then(() => {
                    http.updateCookie().then(() => {
                        location.reload();
                    })
                });
            } catch (error) {
                console.log(error)
                throw error
            }
        },
    },
}
</script>

<style scoped>

</style>
