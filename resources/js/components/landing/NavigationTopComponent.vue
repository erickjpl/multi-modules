<template>
    <v-toolbar dark>
        <v-toolbar-title><a href="/">EL LOGO</a></v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn text :to="{name: 'cart'}">Products</v-btn>

        <v-btn text :to="{name: 'shop'}">Products Opc-2</v-btn>

        <v-btn text @click.stop="setDrawer(true)">
            <v-badge left color="green">
                <span slot="badge"></span>
                <v-icon>mdi-cart</v-icon> Carrito
            </v-badge>
        </v-btn>
    </v-toolbar>
</template>

<script>
    import { mapMutations, mapState } from 'vuex'
export default {
    data: () => ({
    }),
    computed: {
        ...mapState([ 'cartModal' ])
    },
    methods: {
        setDrawer(value) {
            this.OPEN_CART_MODAL(value)
        },
        ...mapMutations({ setDrawer: 'OPEN_CART_MODAL' })
    }
}
</script>

