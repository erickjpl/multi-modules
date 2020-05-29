<template>
    <v-row>
        <v-col v-for="card in cards" :key="card.id" :cols="card.flex">
            <v-card class="d-inline-block mx-auto">
                <v-container>
                    <v-row>
                        <v-col cols="auto">
                            <v-img max-width="250" :src="card.src" />
                        </v-col>

                        <v-col col="auto" class="px-0">
                            <v-card-title class="px-0" v-text="card.product" />
                            <v-card-subtitle class="pb-0 px-0" v-text="card.category" />
                            <v-card-subtitle class="px-0 text-justify">{{ card.description | shorten-text }}</v-card-subtitle>
                        </v-col>

                        <v-divider class="mx-4" vertical></v-divider>

                        <v-col cols="3" class="pl-0">
                            <v-card-text class="px-0">
                                <v-row class="flex-row-reverse">
                                    <v-btn icon class="pt-0">
                                        <v-icon>mdi-heart</v-icon>
                                    </v-btn>
                                    <v-card-title class="pt-1" v-text="card.price"/>
                                </v-row>

                                <v-row align="center" class="mx-0" justify="center">                                
                                    <v-rating :value="card.star" color="amber" dense half-increments readonly size="14"></v-rating>

                                    <div class="grey--text ml-4">
                                        {{ card.star }} ({{ card.sales }})
                                    </div>

                                    <break />

                                    <div class="grey--text">Ultima venta: {{ card.sale_date }}</div>
                                </v-row>

                                <v-card-actions class="justify-center">
                                    <v-btn tile outlined color="indigo">Ver mas</v-btn>
                                    <v-btn tile outlined color="success">
                                        <v-icon left>mdi-cart</v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </v-card-text>
                        </v-col>
                    </v-row>
                </v-container>
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
        }
    }
</script>
