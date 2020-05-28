import Vue from 'vue'
import Vuex from 'vuex'

import products from '@/store/modules/shop/products'
import shoppingCart from '@/store/modules/shop/shopping-cart'
import * as actions from '@/store/modules/shop/actions'
import * as getters from '@/store/modules/shop/getters'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        barColor: 'rgba(0, 0, 0, .8), rgba(0, 0, 0, .8)',
        barImage: 'https://demos.creative-tim.com/material-dashboard/assets/img/sidebar-1.jpg',
        drawer: null,
    },
    mutations: {
        SET_BAR_IMAGE (state, payload) {
            state.barImage = payload
        },
        SET_DRAWER (state, payload) {
            state.drawer = payload
        },
    },
    actions,
    getters,
    modules: {
        products,
        shoppingCart
    },
})
