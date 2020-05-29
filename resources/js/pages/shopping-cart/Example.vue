<template>
    <v-app id="store-front">
        <main>
            <v-container fluid>
                <span>
                    <v-flex wrap>
                        <shop-product-list-component :products=products />
                    </v-flex>

                    <!-- <v-flex order-xs1 order-sm2 >
                        <shop-shopping-cart-component />
                    </v-flex> -->
                </span>
            </v-container>
        </main>
    </v-app>
</template>

<script>
    import '@/plugins/global/shopping-cart'
    import { mapGetters } from 'vuex'

    export default {
        computed: {
            ...mapGetters('products', ['products'])
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