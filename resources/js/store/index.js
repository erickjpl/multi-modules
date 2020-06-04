import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

// General
import state from '@/store/modules/generals/states'
import * as getters from '@/store/modules/generals/getters'
import * as actions from '@/store/modules/generals/actions'
import mutations from '@/store/modules/generals/mutations'

// Modulos
import products from '@/store/modules/products/index'
import shoppingCart from '@/store/modules/shop/index'

Vue.use(Vuex)

export default new Vuex.Store({
    state,
    getters,
    actions,
    mutations,
    modules: {
        products,
        shoppingCart
    },
    plugins: [createPersistedState()]
})
