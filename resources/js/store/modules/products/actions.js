import { ProductRepository } from '@/repositories/ProductRepository'

const actions = {
    async getAllProducts({commit}, q) {
        await ProductRepository.getAll(q)
            .then( response => {
                let paginate = {
                    current_page: response.data.current_page,
                    per_page: response.data.per_page,
                    first_page_url: response.data.first_page_url,
                    last_page_url: response.data.last_page_url,
                    next_page_url: response.data.next_page_url,
                    prev_page_url: response.data.prev_page_url,
                    to: response.data.to,
                    total: response.data.total
                }

                commit( 'PRODUCTS_GET_ALL', response.data.data )
                commit( 'PRODUCTS_PAGINATE', paginate )
            })
            .catch( error   => commit( 'ERROR', error ))
    },
    addItemToCart({ commit }, item) {
        if (item.inventories[0].quantity > 0)
            commit( 'ADD_TO_CART', item.id );
    }
}

export default actions