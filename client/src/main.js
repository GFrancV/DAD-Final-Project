import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'
import router from './router'
import store from './store'
import Toaster from "@meforma/vue-toaster"

let toastOptions = {
    position: 'top',
    timeout: 3000,
    pauseOnHover: true
}

const app = createApp(App).use(store).use(router).use(Toaster, toastOptions)
const url = "http://vcard_api.test"


axios.defaults.baseURL = url + "/api/"
app.config.globalProperties.$axios = axios
app.config.globalProperties.$serverUrl = url

app.config.globalProperties.$vcard = 900000001

app.mount('#app')