export const addItemToCart = ({ commit }, item) => {
    if (item.inventory > 0)
        commit('ADD_TO_CART', item.id);
}

export const removeItemFromCart = ({ commit }, item) => {
    commit('REMOVE_FROM_CART', item);
}