<template>
    <v-app>
        <l-navigation-top-component />
        <v-navigation-drawer

            absolute
            right
            temporary
            >
                <h2>prueba</h2>
        </v-navigation-drawer>
        <l-search-front-component :hotProducts=productsHot />
        <h2>{{ this.$store.state.shoppingCart.cartModal }}</h2>
        <v-content>
            <router-view></router-view>
        </v-content>

        <l-footer-component />
    </v-app>
</template>

<script>
    import '@/plugins/global/landing'
    import { mapGetters, mapActions, mapState, mapMutations} from 'vuex'

    export default {
        name: 'IndexLanding',
        data() {
            return {
                hotProducts: [],
            }
        },
        computed: {
            ...mapGetters('products', ['productsHot']),
            ...mapMutations('shoppingCart', ['OPEN_CART_MODAL'] ),
        },
        created() {
            this.getAllProducts()
        },
        methods: {
            ...mapActions('products', ['getAllProducts']),
        }
    }
</script>
