import Index from '@/pages/landing/Index'
import Home from '@/pages/landing/Home'
import ShoppingCart from '@/pages/shopping-cart/Index'

import Basket from '@/pages/landing/Basket'
import BasketCheckout from '@/pages/landing/BasketCheckout'
import Example from '@/pages/landing/Example'

export default [
    {
        path: '',
        component: Example,
        name: 'landing.index',
        // redirect: { name: 'home' },
        children: [
            {
                path: 'home',
                name: 'home',
                component: Home,
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