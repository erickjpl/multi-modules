<template>
  <v-app>
    <dashboard-core-app-bar />

    <dashboard-core-drawer />

    <dashboard-core-view />

    <dashboard-core-settings />
  </v-app>
</template>

<script>
    import DashboardCoreAppBar from '@/components/dashboard/AppBar'
    import DashboardCoreDrawer from '@/components/dashboard/Drawer'
    import DashboardCoreSettings from '@/components/dashboard/Settings'
    import DashboardCoreView from '@/components/dashboard/View'

    export default {
        components: {
            DashboardCoreAppBar,
            DashboardCoreDrawer,
            DashboardCoreSettings,
            DashboardCoreView
        },
        data: () => ({
            expandOnHover: false,
        })
    }
</script>