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
  }
}
</script>

<style>

</style>
