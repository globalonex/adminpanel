<template>
    <div>
        <!-- This is param means show button open menu  -->
        <Header :show="false" />
        <div class="p-4 sm:ml-0'">
            <div class="p-4 mt-14">
                <slot/>
            </div>
        </div>
    </div>
</template>

<script>
import Header from './../Shared/Header.vue';
import Menu from './../Shared/Menu.vue';

export default {
    name: "AdminLayout",
    components: {
        Header,
        Menu,
    },
    data() {
        return {
            showMenu: {
                type: Boolean,
                default: false,
            }
        }
    }
};
</script>

<style scoped>
/* Стили для макета приложения */
</style>