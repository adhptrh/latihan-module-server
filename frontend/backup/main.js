import Vue from 'vue'
import App from './App.vue'

import http   from './http'
import store  from './store'
import router from './router'
import config from './config'

Vue.config.productionTip = false
new Vue({
  el: '#app',
  http: http,
  store: store,
  router: router,
  config: config,
  render: h => h(App)
});