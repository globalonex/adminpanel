<template>
    <Head :title="title"/>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg">
        <div class="w-full md:w-9/12 md:ml-auto">
            <h1 class="text-2xl md:text-4xl text-center py-3.5 md:py-4 text-[#303133]">{{ title }}</h1>
        </div>
        <form @submit.prevent="onSubmit">
            <div class="flex flex-wrap">
                <div class="flex items-center w-full md:mb-0">
                    <label :class="styles.auth.label" for="grid-username">
                        Email
                    </label>
                    <input :class="styles.auth.input" id="grid-username" type="email" v-model="email" required>
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="flex items-center w-full">
                    <label :class="styles.auth.label" for="grid-password">
                        Пароль
                    </label>
                    <input :class="styles.auth.input" id="grid-password" type="password" v-model="password" required>
                </div>
            </div>
            <div v-if="error">{{ error }}</div>
            <div class="flex items-center w-10/12 md:w-9/12 float-right mr-1 md:mr-0">
                <button :class="styles.button" type="submit" :disabled="buttonDisabled">
                    {{ buttonDisabled ? "Подождите" : "Войти" }}
                </button>
                <InertiaLink href="/register" class="px-5" :class="styles.unbutton">Регистрация</InertiaLink>
            </div>
        </form>
    </div>
</template>

<script>
import {mapActions, mapGetters, mapState} from "vuex";
import styles from '../../components/config/styles';
import {InertiaLink, Head} from '@inertiajs/inertia-vue3';

export default {
    name: "Login",
    components: {
        InertiaLink,
        Head,
    },
    props: {
        title: String
    },
    computed: {
        ...mapGetters(['authStatus']),
    },
    created() {

    },


    data() {
        return {
            styles,
            buttonDisabled: false,
            email: "",
            password: "",
        }
    },

    methods: {
        ...mapActions(['login']),
        onSubmit() {
            const credentials = {
                email: this.email,
                password: this.password,
            };
            this.login(credentials)
                .then((resp) => {
                    if (resp.resp.data.status === 'ok') {
                      // this.$inertia.visit('/admin');
                        window.location.href = '/admin';
                    }
                    // Redirect to dashboard or other protected page
                })
                .catch((e) => {
                    console.error(e)
                    throw e
                    // Handle login error
                });
        },
    },
}
</script>

<style scoped>

</style>
