import Vue from 'vue'
import VueRouter from 'vue-router'

import Index from '@/pages/Index'
import Public from '@/routes/public'
import Dashboard from '@/routes/dashboard'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'index',
        component: Index,
        children: [
            ...Public,
            ...Dashboard
        ]
    }
]

const router = new VueRouter({
    base: process.env.APP_URL,
    mode: "history",
    routes
})

export default router