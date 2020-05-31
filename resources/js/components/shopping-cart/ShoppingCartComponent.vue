<template>
    <div>
        <!-- <div class="display-1" style="text-align:center">Your Cart</div>

        <v-card>
            <v-list two-line>
                <template v-for="item in cartItems">
                    <v-list-item :key="item.title">
                        <v-list-item-avatar><img :src="item.images[0].url"></v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title v-text="item.product" />
                            
                            <v-list-item-subtitle>
                                Quantity: {{ item.inventories[0].quantity }} &nbsp; - &nbsp;
                                {{ item.inventories[0].price | money }}
                            </v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-action>
                            <v-btn icon ripple @click.native="removeItemFromCart(item)">
                                <v-icon class="grey--text text--lighten-1">
                                    close
                                </v-icon>
                            </v-btn>
                        </v-list-item-action>
                    </v-list-item>
                </template>
            </v-list>

            <shop-shopping-cart-totals-component />

            <v-card-actions class="justify-center">
                <v-btn primary v-if="cartItemCount > 0" @click.native.stop="checkout()">
                    Check out
                </v-btn>
            </v-card-actions>
        </v-card>

        <shop-checkout-dialog-component v-model="checkoutDialog" /> -->
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        data() {
            return {
                checkoutDialog: false,
            }
        },
        computed: {
            ...mapGetters('products', ['cartItemCount', 'cartItems']),
        },
        methods: {
            ...mapActions('products', ['removeItemFromCart']),
            checkout() {
                this.checkoutDialog = true;
            }
        }
    }
</script>
