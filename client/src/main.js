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
//Date picker
import Datepicker from "vue3-date-time-picker"
import "vue3-date-time-picker/dist/main.css"

let toastOptions = {
	position: "top",
	timeout: 3000,
	pauseOnHover: true,
}

const app = createApp(App)
	.use(store)
	.use(router)
	.use(Toaster, toastOptions)
	.use(VueChartkick)
	.component("Datepicker", Datepicker)

const url = "http://vcard_api.test"
//const url = "http://localhost:8000"

axios.defaults.baseURL = url + "/api/"
app.config.globalProperties.$axios = axios
app.config.globalProperties.$serverUrl = url

app.mount("#app")
