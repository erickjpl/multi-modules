import ShoppingCart from '@/pages/shopping-cart/Index'

export default [
    {
        path: 'shop',
        name: 'shop',
        component: ShoppingCart,
        /* children: [
            {
                path: 'admin',
                name: 'dashboard.admin',
                components: {
                    dashboard: AdminDashboard
                },
                meta: {
                    auth: {
                        roles: 'admin',
                        redirect: {
                            name: 'login'
                        },
                        forbiddenRedirect: '/403'
                    }
                }
            }
        ] */
    }
]