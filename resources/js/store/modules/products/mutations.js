const mutations = {
    PRODUCTS_GET_ALL( state, products ) {
        state.items = products
    },  
    PRODUCTS_PAGINATE( state, products ) {
        state.paginate = products
    },
    ADD_TO_CART( state, id ) {
        state.items.find( p => p.id === id ).inventories.quantity--
    },  

    /* REVISAR */
    REMOVE_FROM_CART( state, removedProduct ) {
        state.items.find( p => p.id === removedProduct.id ).inventory += removedProduct.quantity
    },

    /* MEJORAR */
    ERROR( state, error ) {
        state.error = error
    }
}

export default mutations