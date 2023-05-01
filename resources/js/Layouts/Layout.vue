<template>

<!--    <Header :show="showMenu" />-->
<!--    <Menu v-if="showMenu"/>-->

<!--    <div class="p-4 " :class="showMenu ? 'sm:ml-64' : 'sm:ml-0'">-->
<!--        <div class="p-4 mt-14">-->
<!--            <slot/>-->
<!--        </div>-->
<!--    </div>-->
        <!-- Общая разметка и стили для всех страниц -->
        <component :is="layout" :isAdminRoute="isAdminRoute" class="background: #F0F2F5;">
            <slot></slot>
        </component>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'
import axios from 'axios';
import Menu from "../Shared/Menu.vue";
import AppLayout from './AppLayout.vue';
import AdminLayout from './AdminLayout.vue';


export default {
    components: {
        AppLayout,
        AdminLayout
    },
    data() {
      return {
          showMenu: {
              type: Boolean,
              default: false,
          },
          layout: "AppLayout",
          // layout: {
          //     type: String,
          //     default: 'AppLayout',
          // } // Макет по умолчанию для гостевых страниц
      }
    },
        computed: {
            isAdminRoute() {
                return window.location.pathname.startsWith('/admin'); // Упрощенное выражение
            },
        },
        mounted() {
            // Проверяем текущий маршрут
            this.$inertia.on('success', () => {
                // Вызываем метод для обновления компонента
                this.updateLayout();
            });

        },
    methods: {
        updateLayout() {
            // this.$forceUpdate(); // Вызываем метод $forceUpdate()
            console.log(this.$page.props);
            if (this.$page.props.isAdminRoute) {
                this.layout = 'AdminLayout'; // Используем макет AdminLayout для страниц администратора
            } else {
                this.layout = 'AppLayout'; // Используем макет AppLayout для гостевых страниц
            }
        }

    },
    created() {
        // Проверяем, является ли текущий пользователь администратором
        // И обновляем макет (layout) в зависимости от этого
        console.log(this.$page.props);
        this.updateLayout()
        if (this.isAdminRoute) {
            this.layout = 'AdminLayout'; // Используем макет AdminLayout для страниц администратора
        } else {
            this.layout = 'AppLayout'; // Используем макет AppLayout для гостевых страниц
        }

    },

};
</script>
