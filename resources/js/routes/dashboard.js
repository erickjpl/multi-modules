import Index from '@/pages/dashboard/Index'

export default [
    {
        path: 'dashboard',
        name: 'dashboard',
        component: Index,
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
