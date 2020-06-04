<template>
    <v-layout row wrap px-0>
        <template v-for="(product, index) in products">
            <v-flex :key="index">
                <v-hover>
                    <v-card slot-scope="{hover}" class="mx-auto" color="gray lighten-4" height="250" min-width="200" max-width="250">
                        <v-img :src="product.images[0].url" :aspect-ratio="16/9">
                            <v-expand-transition>
                                <div v-if="hover" class="d-flex transition-fast-in-fast-out orange draken-2 display-2 v-card--reveal black--text" style="height: 100%;">
                                    <template v-if="product.inventories.length > 0" ma-0 pa-0>
                                        {{ product.inventories[0].price | money }}
                                    </template>
                                    <template v-else>
                                        Agotado
                                    </template>
                                </div>
                            </v-expand-transition>
                        </v-img>

                        <v-card-text class="pt-4" style="position: relative;">
                            <template v-if="product.inventories.length > 0">
                                <v-btn absolute color="orange" class="white--text" 
                                    fab medium right top v-if="product.inventories[0].quantity > 0" 
                                    @click.native="addItemToCart(product)">
                                    
                                    <v-icon>mdi-cart</v-icon>
                                </v-btn>
                            </template>
                            <v-btn absolute disabled class="white--text" fab medium right top v-else>
                                <v-icon>mdi-cart</v-icon>
                            </v-btn>

                            <small class="font-weight-light grey--text mb-2">{{product.category_name}}</small>
                            <p class="font-weight-light orange--text mb-2">{{product.product}}</p>

                            <!-- <div class="font-weight-light mb-2">{{product.description}}</div> -->
                        </v-card-text>
                    </v-card>
                </v-hover>
            </v-flex>
        </template>
    </v-layout>
</template>

<script>
    import { mapActions } from 'vuex'
   
   export default {
        props: {
            products: {
                type: Array,
				required: true
            }
        },
        methods: {
            ...mapActions('products', ['addItemToCart'])
        }
    }
</script>

<style scoped>
    .v-card--reveal {
        align-items: center;
        bottom: 0;
        justify-content: center;
        opacity: 0.5;
        position: absolute;
        width: 100%; 
    }

    .v-card h3.display-1 {
        font-size: 24px !important;
    }
</style>
