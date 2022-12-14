import { Controller } from '@hotwired/stimulus'
import { createApp } from 'vue'

import {vuetify} from '@/plugins/vuetify/vuetify'
import Login from '@/views/Login.vue'

export default class extends Controller {
    connect() {
        const login = createApp(Login)

        login.use(vuetify)

        login.mount(this.element)
    }
}
