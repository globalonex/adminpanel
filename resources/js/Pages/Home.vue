<template>
    <main class="my-10 flex flex-col content-center justify-center text-center">
        <h1 class="font-bold text-xl md:text-4xl">Добро пожаловать на страницу складского учета!</h1>
        <p class="font-regular font-base py-4 text-lg font-regular">Здесь вы найдете информацию о текущем состоянии вашего склада, включая количество товаров на складе, расходы и доходы, а также статистику продаж.</p>

        <inertia-link href="/login" class="my-2 w-auto self-center" :class="styles.button">Авторизация</inertia-link>
        <inertia-link href="/register" class="my-2 w-auto self-center" :class="styles.button">Регистрация</inertia-link>

    </main>

</template>

<script>
import { InertiaLink } from '@inertiajs/inertia-vue3'
import styles from '../components/config/styles';
export default {
    components: {
        InertiaLink,
    },
    data() {
        return {
            styles
        }
    }
}
</script>
