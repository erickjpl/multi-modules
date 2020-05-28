export const loadProducts = ({ commit }) => {
    commit('LOAD_PRODUCTS', [
        {
            id: 'kitchen-1',
            image: 'https://cdn.vuetifyjs.com/images/cards/kitchen.png',
            title: 'QW cooking utensils',
            description: 'Our vintage kitchen utenils delight any chef. Made of bamboo by hand',
            price: '14.99',
            inventory: 8
        },
        {
            id: 'kitchen-2',
            image: 'https://cdn.vuetifyjs.com/images/cards/kitchen.png',
            title: 'QW cooking utensils',
            description: 'Our vintage kitchen utenils delight any chef. Made of bamboo by hand',
            price: '14.99',
            inventory: 8
        },
        {
            id: 'kitchen-3',
            image: 'https://cdn.vuetifyjs.com/images/cards/kitchen.png',
            title: 'QW cooking utensils',
            description: 'Our vintage kitchen utenils delight any chef. Made of bamboo by hand',
            price: '14.99',
            inventory: 8
        },
        {
            id: 'kitchen-4',
            image: 'https://cdn.vuetifyjs.com/images/cards/kitchen.png',
            title: 'QW cooking utensils',
            description: 'Our vintage kitchen utenils delight any chef. Made of bamboo by hand',
            price: '14.99',
            inventory: 8
        },
        {
            id: 'kitchen-5',
            image: 'https://cdn.vuetifyjs.com/images/cards/kitchen.png',
            title: 'QW cooking utensils',
            description: 'Our vintage kitchen utenils delight any chef. Made of bamboo by hand',
            price: '14.99',
            inventory: 8
        },
        {
            id: 'kitchen-6',
            image: 'https://cdn.vuetifyjs.com/images/cards/kitchen.png',
            title: 'QW cooking utensils',
            description: 'Our vintage kitchen utenils delight any chef. Made of bamboo by hand',
            price: '14.99',
            inventory: 8
        },
        {
            id: 'kitchen-7',
            image: 'https://cdn.vuetifyjs.com/images/cards/kitchen.png',
            title: 'QW cooking utensils',
            description: 'Our vintage kitchen utenils delight any chef. Made of bamboo by hand',
            price: '14.99',
            inventory: 8
        },
        {
            id: 'kitchen-8',
            image: 'https://cdn.vuetifyjs.com/images/cards/kitchen.png',
            title: 'QW cooking utensils',
            description: 'Our vintage kitchen utenils delight any chef. Made of bamboo by hand',
            price: '14.99',
            inventory: 8
        }
    ]);
}

export const addItemToCart = ({ commit }, item) => {
    if (item.inventory > 0)
        commit('ADD_TO_CART', item.id);
}

export const removeItemFromCart = ({ commit }, item) => {
    commit('REMOVE_FROM_CART', item);
}