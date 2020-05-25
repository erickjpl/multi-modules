import Index from '@/pages/dashboard/Index'
import Dashboard from '@/pages/dashboard/Dashboard'

export default [
    {
        path: 'dashboard',
        name: 'dashboard',
        component: Index,
        redirect: { name: 'dashboard.index' },
        children: [
            {
                path: 'index',
                name: 'dashboard.index',
                component: Dashboard
            }
        ]
    }
]
