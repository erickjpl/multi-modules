<template>
    <v-row>
        <v-col v-for="card in cards" :key="card.id" :cols="card.flex" class="hidden-sm-and-down">
            <v-card class="d-inline-block mx-auto">
                <v-container>
                    <v-row>
                        <v-col cols="auto">
                            <v-img max-width="250" :src="card.src" />
                        </v-col>

                        <v-col col="auto" class="pl-0">
                            <v-card-title v-text="card.product" />
                            <v-card-subtitle class="pb-0" v-text="card.category" />
                            <v-card-subtitle>{{ card.description | shorten-text }}</v-card-subtitle>
                        </v-col>

                        <v-divider class="mx-4" vertical></v-divider>

                        <v-col cols="3" class="pl-0">
                            <v-card-text>
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

                                    <v-row align="center" justify="center">
                                        <div class="grey--text">Ultima venta: {{ card.sale_date }}</div>
                                    </v-row>
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