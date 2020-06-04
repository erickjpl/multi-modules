<template>
    <v-navigation-drawer absolute temporary right v-model="cartModal" width="500">
        <v-divider></v-divider>
    </v-navigation-drawer>
</template>

<script>
    import { mapState} from 'vuex'
export default {
    data: () => ({
    }),
    computed: {
        cartModal: {
            get () {
                return this.$store.state.cartModal
            },
            set (val) {
                this.$store.commit('OPEN_CART_MODAL', val)
            }
        }
    }
}
</script>
