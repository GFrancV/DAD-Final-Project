import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import { createApp } from "vue"
import App from "./App.vue"
import axios from "axios"
import router from "./router"
import store from "./store"
//Notify plugin
import Toaster from "@meforma/vue-toaster"
//Chars plugin
import VueChartkick from "vue-chartkick"
import "chartkick/chart.js"

let toastOptions = {
	position: "top",
	timeout: 3000,
	pauseOnHover: true,
}

const app = createApp(App).use(store).use(router).use(Toaster, toastOptions).use(VueChartkick)
const url = "http://vcard_api.test"

axios.defaults.baseURL = url + "/api/"
app.config.globalProperties.$axios = axios
app.config.globalProperties.$serverUrl = url

app.mount("#app")
