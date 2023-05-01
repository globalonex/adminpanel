<template>
    <Header :show="showMenu"/>
    <Menu/>
    <div class="pre-content bg-white">
        <div class="p-4 sm:ml-64 px-5 mt-3 md:mt-14">
            <div class="breadcrumbs">
                <breadcrumbs :breadcrumbs="breadcrumbs"/>
            </div>
            <h1 class="text-left text-xl my-1">{{ this.$page.props.title ?? "The title not specified " }}</h1>
            <p class="text-left text-sm mt-4">{{ this.$page.props.describe ?? "Текстовое описание для раздела" }}</p>
        </div>
    </div>
    <div class="pt-4 sm:ml-64 px-5">
        <div class="bg-white">
            <slot/>
        </div>
    </div>
</template>

<script>
import Header from "../Shared/Header.vue";
import Menu from "../Shared/Menu.vue";
import Breadcrumbs from './../Shared/Breadcrumbs.vue'

export default {
    name: "AdminLayout",
    components: {
        Header,
        Menu,
        Breadcrumbs
    },

    data() {
        return {
            breadcrumbs: this.$page.props.breadcrumbs,
            showMenu: {
                type: Boolean,
                default: false,
            }
        }
    },

}
</script>

<style scoped>
.pre-content > h1, h2, h3, h4, h5, h6, p {
    color: #303133;
}
</style>