<template>
    <Head :title="title"/>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg">
        <div class="w-full md:w-9/12 md:ml-auto">
            <h1 class="text-2xl md:text-4xl text-center py-3.5 md:py-4 text-[#303133]">{{ title }}</h1>
        </div>
        <form @submit.prevent="register">
            <div class="flex flex-wrap">
                <div class="flex items-center w-full md:mb-0">
                    <label :class="styles.auth.label" for="grid-username">
                        Email
                    </label>
                    <input :class="styles.auth.input" id="grid-username" type="email" v-model="email">
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="flex items-center w-full">
                    <label :class="styles.auth.label" for="grid-password">
                        Пароль
                    </label>
                    <input :class="styles.auth.input" id="grid-password" type="password" v-model="password">
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="flex items-center w-full">
                    <label :class="styles.auth.label" for="grid-password">
                        Повторите пароль
                    </label>
                    <input :class="styles.auth.input" id="grid-password" type="password" v-model="password_confirmation">
                </div>
            </div>
            <div class="flex items-center justify-between w-10/12 md:w-9/12 float-right">
                <button :class="styles.button" type="submit">
                    Зарегистрироваться
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import {Head} from "@inertiajs/inertia-vue3";
import styles from '../../components/config/styles';
export default {
    name: "Register",
    components: {
        Head
    },
    props: {
        title: String
    },
    data() {
        return {
            styles,
            email: "",
            password: "",
            password_confirmation: "",
            errors: {

            }
        }
    },
    methods: {
        async register() {
            try {
                // this.buttonDisabled = true;
                // const resp = await auth.setRegister(this.email, this.password, this.password_confirmation)
                // setTimeout(() => {
                //     this.buttonDisabled = false;
                // }, 3000)
                if (resp.data.status === 'ok') {
                    this.$inertia.visit('/login')
                }
            } catch (error) {
                this.error = 'Неправильный логин или пароль'
            }
        }

    }
}
</script>

<style scoped>

</style>
