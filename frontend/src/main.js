import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import Toast, { POSITION } from "vue-toastification"
import "vue-toastification/dist/index.css"
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

const pinia = createPinia()

pinia.use(piniaPluginPersistedstate)

const app = createApp(App);
const options = {
    position: POSITION.BOTTOM_RIGHT,
    timeout: 2000,
    closeOnClick: true,
    pauseOnHover: true,
    draggable: true,
}

app.use(createPinia())
app.use(router)
app.use(Toast, options)
app.mount('#app')
