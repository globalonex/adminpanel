<template>
    <header>
        <nav class="bg-[#304156]">
            <div class="max-w-7xl mx-auto">
                <div class="relative flex items-center justify-between h-16">
                    <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex space-x-4 sm:px-4 w-full justify-between">
                            <inertia-link href="/" class="text-white font-semibold relative px-2.5 md:px-0">Складной
                                учет <span
                                    class="text-sm font-regular absolute -top-1 -right-3">&#946;</span></inertia-link>
                            <inertia-link href="/admin" v-if="user" class="text-white px-2.5 md:px-0">{{
                                    user.email
                                }}
                            </inertia-link>
                          <Dropdown/>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import {InertiaLink} from '@inertiajs/inertia-vue3'

import UserIcon from './Header/UserIcon.vue'
import {mapActions, mapGetters, mapState} from "vuex";
import Dropdown from "./Dropdown.vue";

export default {
    name: "Header",
    components: {
      Dropdown,
        InertiaLink,
    },
    data() {
        return {
            user: null
        }
    },
    computed: {
        ...mapGetters(['currentUser'])
    },

    methods: {
        // ...mapActions(['getUser']),
        logout() {
            // Implement logout logic
            // delete access-token
            // and refresh page or visit/push
        }
    }
}
</script>

<style scoped>

</style>
