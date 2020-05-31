export const removeItemFromCart = ({ commit }, item) => {
    commit('REMOVE_FROM_CART', item);
}