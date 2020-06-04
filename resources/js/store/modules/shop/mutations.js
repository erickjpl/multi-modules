const mutations = {
    ADD_TO_CART (state, id) {
        const found = state.items.find( (p) => p.id == id )

        if (found)
            found.quantity++;
        else
            state.items.push({ id: id, quantity: 1 })
    },

    REMOVE_FROM_CART (state, removedProduct) {
        const index = state.items.findIndex(
            (currentItem) => currentItem.id === removedProduct.id
        )

        state.items.splice(index, 1)
    }
}

export default mutations
