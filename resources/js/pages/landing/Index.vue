<template>
    <v-app>
        <l-navigation-top-component />

        <l-search-front-component :hotProducts=productsHot />

        <v-content>
            <router-view></router-view>
        </v-content>

        <l-footer-component />
    </v-app>
</template>

<script>
    import '@/plugins/global/landing'
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: 'IndexLanding',
        data() {
            return {
                hotProducts: []
            }
        },
        computed: {
            ...mapGetters('products', ['productsHot'])
        },
        created() {
            this.getAllProducts()
        },
        methods: {
            ...mapActions('products', ['getAllProducts'])
        }
    }
</script>
