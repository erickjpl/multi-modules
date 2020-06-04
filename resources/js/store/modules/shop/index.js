import state from '@/store/modules/shop/state'
import * as getters from '@/store/modules/shop/getters'
import actions from '@/store/modules/shop/actions'
import mutations from '@/store/modules/shop/mutations'

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}