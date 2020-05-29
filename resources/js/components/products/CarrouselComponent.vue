<template>
    <v-carousel cycle hide-delimiter-background show-arrows-on-hover height="250">
        <v-carousel-item v-for="(pluck, i) in products" :key="i">
            <!-- <v-sheet :color="colors[i]" height="100%"> -->
                <hot-product-component :products=pluck />
            <!-- </v-sheet> -->
        </v-carousel-item>
    </v-carousel>
</template>

<script>
    export default {
        props: {
            products: {
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