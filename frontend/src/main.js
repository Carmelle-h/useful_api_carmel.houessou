import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import { createToaster } from '@meforma/vue-toaster'
import 'vue-toastification/dist/index.css'; 


const app = createApp(App);
const toaster = createToaster();

app.use(createPinia())
app.use(router)
app.use(toaster)

app.mount('#app')
