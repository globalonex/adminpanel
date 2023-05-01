<template>
    <div class="p-3">
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
             role="alert">
            <span class="font-medium">Вы успешно вошли!</span>
        </div>
        <p class="p-4 text-sm md:text-xl">Для того чтобы перемещаться по сайту, используйте пункты меню.</p>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import http from "../../components/scripts/http/axios";

export default {
    name: "Index",
    props: {
        title: String,
        user: Object
    },
}
</script>

<style scoped>

</style>
