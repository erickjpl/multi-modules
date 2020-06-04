<template>
    <v-app>
        <l-navigation-top-component />
        <navigation-drawer-cart />
        <l-search-front-component :hotProducts=productsHot />
        <v-content>
            <router-view></router-view>
        </v-content>

        <l-footer-component />
    </v-app>
</template>

<script>
    import '@/plugins/global/landing'
    import { mapGetters, mapActions} from 'vuex'
    import NavigationDrawerCart from '../../components/shopping-cart/NavigationDrawerCart'

    export default {
        name: 'IndexLanding',
        data() {
            return {
                hotProducts: [],
            }
        },
        components:{ NavigationDrawerCart },
        computed: {
            ...mapGetters('products', ['productsHot'])
        },
        created() {
            this.getAllProducts()
        },
        methods: {
            ...mapActions('products', ['getAllProducts']),
        }
    }
</script>
