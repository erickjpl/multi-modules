export const paginate = state => {
    return state.paginate
}

export const products = state => {
    return state.items
}

export const productsHot = state => {
    let products = state.items.slice(0)
    let hot = []

    products = products.sort(( a, b ) => b.most_selled - a.most_selled ).splice(0, 12)
    
    for ( let index = 0; index < 3; index++ ) {
        hot.push( products.splice(0, 4) )
    }

    return hot
}