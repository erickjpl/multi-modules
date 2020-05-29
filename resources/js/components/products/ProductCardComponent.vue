<template>
    <v-card raised hover height="400px" min-width="200" max-width="300">
        <v-img class="white--text" height="200px" :src="product.images[0].url">
            <v-container fill-height fluid>
                <v-layout fill-height>
                    <v-flex xs12 align-end flexbox>
                        <span class="headline shadow-text">
                            {{ product.product }}
                        </span>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-img>

        <v-card-text class="pb-0 fade-out product-card-description">
            {{ product.description | shorten-text }}
        </v-card-text>

        <v-card-text class="pb-0 center-text">
            <template v-if="product.inventories.length > 0">
                {{ product.inventories[0].price | money }} &nbsp; - &nbsp;
                Stock: {{ product.inventories[0].quantity }}
            </template>
        </v-card-text>

        <v-card-actions class="justify-center">
            <template v-if="product.inventories.length > 0">
                <v-btn primary v-if="product.inventories[0].quantity > 0" 
                    @click.native="addItemToCart(product)">Add to Cart
                </v-btn>

                <v-btn disabled v-if="product.inventories[0].quantity <= 0">
                    Sold Out
                </v-btn>
            </template>
            <v-btn disabled v-else>
                Agotado
            </v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
    import { mapActions } from 'vuex'
  
    export default {
        props: {
            product: {
                required: true
            }
        },
        methods: {
            ...mapActions('products', ['addItemToCart'])
        }
    }
</script>
