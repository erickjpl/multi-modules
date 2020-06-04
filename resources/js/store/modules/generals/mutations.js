const mutations = {
    // Dashboard
    SET_BAR_IMAGE(state, payload) {
        state.barImage = payload;
    },
    SET_DRAWER(state, payload) {
        state.drawer = payload;
    },
    OPEN_CART_MODAL(state, value) {
        console.log(state)
        state.cartModal = value;
    }
};

export default mutations
