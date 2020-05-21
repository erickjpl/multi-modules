<template>
    <v-row class="flex-wrap">
        <v-col v-for="card in cards" :key="card.id">
            <v-card class="d-inline-block">
                <v-img :src="card.src" class="white--text align-end" 
                    gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)" 
                    height="200px" max-width="200px">
                    <v-card-title v-text="card.product"></v-card-title>
                </v-img>

                <v-card-actions>
                    <div class="grey--text">{{ card.price }}</div>

                    <v-spacer></v-spacer>

                    <v-btn icon>
                        <v-icon>mdi-heart</v-icon>
                    </v-btn>

                    <v-btn icon tile outlined color="indigo">
                        <v-icon>mdi-bookmark</v-icon>
                    </v-btn>

                    <v-btn icon tile outlined color="success">
                        <v-icon>mdi-cart</v-icon>
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
    export default {
        props: {
            cards: {
                type: Array,
                required: true
            }
        },
        data: () => ({
            
        })
    }
</script>

<style scoped>
    .inline {
        display: inline-block;
    }
</style>