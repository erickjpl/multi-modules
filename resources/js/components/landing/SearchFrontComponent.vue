<template>
    <v-parallax height="350" drak src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg">
        <v-container fluid grid-list-xl>
            <v-layout justify-center row wrap>
                <!-- <v-flex xs12 style="text-align: center;"> -->
                    <!-- <h4 class="subheading">Find what your missing</h4> -->
                <!-- </v-flex> -->

                <v-flex xs12 justify-center row wrap>
                    <h2 class="display-3 font-weight-thin mb-3">Los más vendidos</h2>
                    <carrousel :products=hotProducts />
                </v-flex>
            </v-layout>
        </v-container>
    </v-parallax>
</template>

<script>
    import Carrousel from '@/components/shopping-cart/CarrouselComponent'
    
    export default {
        components: {
            Carrousel
        },
        props: {
            hotProducts: {
                type: Array,
				required: true
            }
        },
        data() {
            return {
                colors: [
                    'indigo',
                    'warning',
                    'pink darken-2',
                    'red lighten-1',
                    'deep-purple accent-4',
                ]
            }
        }
    }
</script>