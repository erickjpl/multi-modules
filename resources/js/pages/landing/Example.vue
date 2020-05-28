<template>
    <v-app id="store-front">
        <v-navigation-drawer />

        <s-toolbar />

        <main>
            <v-container fluid>
                <s-coupons />

                <v-layout row wrap>
                    <v-flex xs12 sm8 md9 lg10 order-xs2 order-sm1 style="flex:1">
                        <s-product-list />
                    </v-flex>

                    <v-flex xs12 sm4 md3 lg2 order-xs1 order-sm2 style="flex:1;min-width:360px">
                        <s-shopping-cart />
                    </v-flex>
                </v-layout>

            </v-container>
        </main>

        <v-footer />
    </v-app>
</template>

<script>
    import  SToolbar from '@/components/shopping-cart/example/ToolbarComponent'
    import  SProductList from '@/components/shopping-cart/example/ProductListComponent'
    import  SShoppingCart from '@/components/shopping-cart/example/ShoppingCartComponent'
    import  SCoupons from '@/components/shopping-cart/example/CouponsComponent'

    export default {
        components: {
            SToolbar,
            SProductList,
            SShoppingCart,
            SCoupons
        },
        created() {
            this.$store.dispatch('loadProducts',null)
        }
    }
</script>

<style>
    .input-group > .layout {
        margin-top: -18px;
    }
    .product-card-description {
        height: 100px;
        min-height: 100px;
        max-height: 100px;
        overflow: hidden;
    }
    /* .fade-out {
        background: -webkit-linear-gradient(rgba(0,0,0,1), rgba(0,0,0,1) 70%, rgba(0,0,0,0));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    } */
    .center-text {
        text-align: center;
    }
    .justify-center {
        justify-content: center;
    }
    .shadow-text {
        text-shadow: 1px 1px #000000;
    }
</style>