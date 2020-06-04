import state from '@/store/modules/products/state'
import * as getters from '@/store/modules/products/getters'
import actions from '@/store/modules/products/actions'
import mutations from '@/store/modules/products/mutations'

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
  