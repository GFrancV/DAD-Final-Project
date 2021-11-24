import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios'
import router from './router'
import store from './store'

const app = createApp(App).use(store).use(router)
const url = "http://vcard_api.test"


axios.defaults.baseURL = url + "/api/"
app.config.globalProperties.$axios = axios
app.config.globalProperties.$serverUrl = url

app.mount('#app')