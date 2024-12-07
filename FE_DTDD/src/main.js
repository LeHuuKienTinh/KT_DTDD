import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import DefaultLayout from './layout/wrapper/Master.vue'
import AuthLayout from './layout/wrapper/AuthMaster.vue'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import { VueToaster } from '@meforma/vue-toaster'

const app = createApp(App)

// Chỉ cần sử dụng app.use(VueToaster)
app.use(router)
app.use(VueToaster)

app.component("default-layout", DefaultLayout)
app.component("auth-layout", AuthLayout)

app.mount("#app")
