import { createApp } from "vue"

import vuetify from '@/plugins/vuetify'
import Login from '@/Login.vue'

const login = createApp(Login)

login.use(vuetify)

login.mount('#login')
