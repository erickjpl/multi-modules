<template>
    <v-app id="store-front">
        <main>
            <v-container fluid>
                <span>
                    <v-flex wrap>
                        <product-list-component :products=products />

                        <div class="text-center text-xs-center pt-2">
                            <v-pagination 
                                v-model="paginate.current_page" 
                                :length="pages" 
                                @input="page"
                                circle 
                            />
                        </div>
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
    import '@/plugins/global/product'
    import { mapGetters, mapActions } from 'vuex'

    export default {
        computed: {
            ...mapGetters('products', ['products', 'paginate']),
            pages () {
                return this.paginate 
                    ? Math.ceil( this.paginate.total / this.paginate.per_page ) 
                    : 0
            }
        },
        methods: {
            ...mapActions('products', ['getAllProducts']),
            page(page) {
                console.info( 'page' )
                this.getAllProducts({ page: page })
            }
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