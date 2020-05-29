import Index from '@/pages/landing/Index'
import Home from '@/pages/landing/Home'
import ShoppingCart from '@/pages/shopping-cart/Index'

import Basket from '@/pages/shopping-cart/Basket'
import BasketCheckout from '@/pages/shopping-cart/BasketCheckout'
import Example from '@/pages/shopping-cart/Example'

export default [
    {
        path: '',
        component: Index,
        name: 'landing.index',
        redirect: { name: 'home' },
        children: [
            {
                path: 'home',
                name: 'home',
                component: Home,
            },
            {
                path: 'cart',
                name: 'cart',
                component: Example,
            },
            {
                path: 'shop',
                name: 'shop',
                component: ShoppingCart,
            },
            {
                path: 'basket',
                name: 'basket',
                component: Basket,
                children: [
                    {
                        path: 'checkout',
                        name: 'basket-checkout',
                        component: BasketCheckout
                    }
                ]
            }
        ]
    }
]