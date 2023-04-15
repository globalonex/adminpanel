<template>
  <div>
    <h1 class="text-center text-2xl my-2">{{ title }}</h1>
    <!--    <p v-if="isAuthenticated">Вы вошли в систему как {{ user.name }}</p>-->
    <button @click="onLogout">Выйти</button>
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
  computed: {
    ...mapGetters(['isAuthenticated', 'user']),
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
