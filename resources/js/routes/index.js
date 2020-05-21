import Vue from 'vue'
import VueRouter from 'vue-router'

import ShoppingCart from '@/pages/shopping-cart/Index'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'index',
        component: ShoppingCart
    }
]

const router = new VueRouter({
    mode: "history",
    routes
})

export default router