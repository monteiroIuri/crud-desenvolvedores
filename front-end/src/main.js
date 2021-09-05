import Vue from 'vue'
import App from './App.vue'
import router from './router/router'
import axios from "axios"
import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
axios.defaults.baseURL = "http://localhost:8000/api"
Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router
}).$mount('#app')
