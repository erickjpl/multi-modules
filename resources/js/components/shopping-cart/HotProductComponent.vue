<template>
    <v-layout row wrap px-0>
        <template v-for="(product, index) in products">
            <v-flex :key="index">
                <v-hover>
                    <v-card slot-scope="{hover}" class="mx-auto" color="gray lighten-4" height="250" min-width="200" max-width="250">
                        <v-img :src="product.images[0].url" :aspect-ratio="16/9">
                            <v-expand-transition>
                                <div v-if="hover" class="d-flex transition-fast-in-fast-out orange draken-2 display-3 v-card--reveal display3 black--text" style="height: 100%;">
                                    ${{ product.inventories[0].price }}
                                </div>
                            </v-expand-transition>
                        </v-img>

                        <v-card-text class="pt-4" style="position: relative;">
                            <v-btn absolute color="orange" class="white--text" fab medium right top>
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
    export default {
        props: {
            products: {
                type: Array,
				required: true
            }
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
