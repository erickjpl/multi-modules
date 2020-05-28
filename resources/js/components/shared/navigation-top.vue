<template>
    <div>
        <v-navigation-drawer v-model="drawer" app temporary>
            <v-list>
                <v-list-item>
                    <v-list-item-content>
                        <v-list-item-title>Menu</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                
                <v-divider></v-divider>

                <template v-for="(item, index) in items">
                    <v-list-item :key="index" :href="item.href">
                        <v-list-item-action>
                            <v-icon light v-html="item.icon"></v-icon>
                        </v-list-item-action>

                        <v-list-item-action>
                            <v-list-item-title v-html="item.title"></v-list-item-title>
                        </v-list-item-action>
                    </v-list-item>
                </template>
            </v-list>
        </v-navigation-drawer>

        <v-toolbar dark>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title><a href="/">ShoppingCart</a></v-toolbar-title>

            <v-spacer></v-spacer>

            <v-btn icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>

            <v-btn icon>
                <v-icon>mdi-heart</v-icon>
            </v-btn>

            <v-btn icon>
                <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>

            <v-btn>Products</v-btn>

            <v-btn :to="{name: 'basket'}">
                <v-badge left color="green">
                    <span slot="badge">5</span>
                    <v-icon>mdi-cart</v-icon> Basket
                </v-badge>
            </v-btn>
        </v-toolbar>
    </div>
</template>

<script>
    export default {
        data: () => ({
            drawer: false,
            items: [{
                icon: 'mdi-account',
                href: '#',
                title: 'Account'
            },{
                icon: 'mdi-account',
                href: '#',
                title: 'Other'
            }]
        })
    }
</script>

<style>

</style>