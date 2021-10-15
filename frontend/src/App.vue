<template>
  <div id="app">
    <Navbar v-if="$route.name !== 'Login'" />
    <router-view />
  </div>
</template>

<script>
import Navbar from "./components/Navbar.vue"
export default {
  name: 'App',
  components: {
    Navbar
  },
  mounted() {
    console.log(this.$route)
    this.$http.interceptors.response.use(function (response) {
        return response;
    }, function (error) {
        if (401 === error.response.status) {
            this.$router.push({name:"Login"})
        } else {
            return Promise.reject(error);
        }
    });
  }
}
</script>

<style>

</style>
