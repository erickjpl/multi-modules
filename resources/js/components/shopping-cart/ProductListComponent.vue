<template>
    <span>
        <v-layout row wrap>
            <v-flex>
                <div class="display-1">Products</div>
            </v-flex>

            <v-flex>
                <v-text-field
                    id="product-search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                    v-model="filter"
                />
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-row class="d-flex" justify="center" v-for="item in filteredProducts" :key="item.id">
                <shop-product-card-component :product="item" />
            </v-row>
        </v-layout>
    </span>
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
                filter: ''
            }
        },
        computed: {
            filteredProducts() {
                return this.products.filter((product) => {
                    return (! this.filter.length )
                        || product.product.toLowerCase()
                            .includes(this.filter.toLowerCase())
                        || product.description.toLowerCase()
                            .includes(this.filter.toLowerCase());
                })
            }
        }
    }
</script>
