import Vue from 'vue'
import router from "./route"
import http from './http'
import App from './App.vue'

Vue.config.productionTip = false

new Vue({
  el:"#app",
  http,
  router,
  render: h => h(App),
})