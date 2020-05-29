<template>
    <v-toolbar dark>
        <v-toolbar-title><a href="/">EL LOGO</a></v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn text :to="{name: 'cart'}">Products</v-btn>

        <v-btn text :to="{name: 'shop'}">Products Opc-2</v-btn>

        <v-btn text :to="{name: 'basket'}">
            <v-badge left color="green">
                <span slot="badge">5</span>
                <v-icon>mdi-cart</v-icon> Carrito
            </v-badge>
        </v-btn>
    </v-toolbar>
</template>

<script>
    export default {
        data: () => ({

        })
    }
</script>