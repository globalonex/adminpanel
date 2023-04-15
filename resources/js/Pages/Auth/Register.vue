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
          <input :class="styles.auth.input" id="grid-password" type="password" v-model="repassword">
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
import {mapActions} from "vuex";

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
      repassword: "",
      errors: {}
    }
  },
  methods: {
    ...mapActions(['register']),
    onSubmit() {
      const credentials = {
        email: this.email,
        password: this.password,
        password_confirmation: this.repassword
      };
      this.register(credentials)
          .then((resp) => {
            console.log(resp)
            if (resp.data.status === 'ok') {
              this.$inertia.visit('/admin');
            }
            // Redirect to dashboard or other protected page
          })
          .catch((e) => {
            console.error(e)
            throw e
            // Handle login error
          });
    }

  }
}
</script>

<style scoped>

</style>
