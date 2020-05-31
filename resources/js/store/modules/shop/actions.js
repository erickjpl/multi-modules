const actions = {
    addItemToCart({ commit }, item) {
        if (item.inventories[0].quantity > 0)
            commit( 'ADD_TO_CART', item.id );
    }
}

export default actions