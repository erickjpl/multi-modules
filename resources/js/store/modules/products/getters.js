export const products = state => {
    return state.items
}

export const productsHot = state => {
    let products = state.items.slice(0)
    let hot = []

    products = products.sort(( a, b ) => b.most_selled - a.most_selled ).splice(0, 12)
    
    for (let index = 0; index < 3; index++) {
        hot.push( products.splice(0, 4) )
    }

    return hot
}



/**
 * EN REVISION
 */
export const cartItemList = state => {
    return state.shoppingCart.items
}

export const cartItems = state => {
    let items = state.shoppingCart.items
    let cart = []

    items.forEach((item, index) => {
        let found = state.products.items.find( (p) => item.id === p.id )

        cart.push({ ...found, quantity: item.quantity })
    })

    return cart
}

export const cartItemCount = state => {
    return cartItems(state).reduce( (total, current) => {
        return total + current['quantity']
    }, 0)
}

export const cartSubtotal = state => {
    return calculateCart(state, 'price')
}

export const cartShipping = state => {
    return calculateCart(state, 'shipping')
}

export const cartTaxes = state => {
    return Math.floor(
        calculateCart(state, 'price') * .04166 // TODO: tax rate
    )
}

export const cartGrandTotal = state => {
    return cartSubtotal(state) + cartShipping(state) + cartTaxes(state)
}

const calculateCart = (state, value) => {
    return cartItems(state).reduce( (total, current) => {
        return total + (current[value] * current['quantity'])
    }, 0)
}
