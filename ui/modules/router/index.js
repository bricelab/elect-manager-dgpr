import process from 'process'
import { createRouter, createWebHashHistory } from 'vue-router'
import { routes } from '@/modules/router/routes'

export default createRouter ({
    history: createWebHashHistory(process.env.BASE_URL),
    routes,
    scrollBehavior() {
        return { top: 0 }
    },
})
