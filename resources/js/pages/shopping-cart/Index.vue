<template>
    <v-app>        
        <v-content>
            <v-container fluid>
                <list-big-cards :cards="cards" class="hidden-sm-and-down" />
                <list-short-cards :cards="cards" class="hidden-md-and-up" />
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    import ListBigCards from '@/components/shopping-cart/example/ListBigCardComponent'
    import ListShortCards from '@/components/shopping-cart/example/ListShortCardComponent'

    export default {
        components: {
            ListBigCards,
            ListShortCards
        },
        data: () => ({
            items: [
                { title: 'Home', icon: 'mdi-home-city' },
                { title: 'My Account', icon: 'mdi-account' },
                { title: 'Users', icon: 'mdi-account-group-outline' },
            ],
            cards: [
                { 
                    id: 1,
                    product: 'Legacy Program Specialist', 
                    category: 'Optimization', 
                    description: 'Odio laborum sequi similique veritatis non minima. Omnis ducimus laudantium qui rem. Velit temporibus ducimus delectus et quis expedita pariatur. Quos explicabo eos dolorem omnis et cumque aut quaerat quasi. Eum omnis laudantium natus neque. Repellendus qui iusto natus voluptate autem officia facilis.', 
                    src: 'https://cdn.vuetifyjs.com/images/cards/house.jpg', 
                    price: 12.30,
                    star: 12.30,
                    sales: 354,
                    flex: 12,
                    sale_date: "12/02/2020"
                },
                { 
                    id: 2,
                    product: 'Legacy Branding Manager', 
                    category: 'Configuration', 
                    description: 'Ipsam illum ipsum nostrum. Sed a accusamus similique in consequatur. Qui distinctio placeat ab quasi eveniet quis quidem.', 
                    src: 'https://cdn.vuetifyjs.com/images/cards/house.jpg', 
                    price: 12.30,
                    star: 12.30,
                    sales: 354,
                    flex: 12,
                    sale_date: "12/02/2020"
                },
                { 
                    id: 3,
                    product: 'Legacy Factors Engineer', 
                    category: 'Data', 
                    description: 'Numquam error sed quam reprehenderit nulla. Eaque nihil itaque molestias. Ut reiciendis omnis libero ut ad. Vero blanditiis consequatur est. Molestiae cupiditate a commodi voluptatem qui est sint sapiente. Qui ratione pariatur repellendus eveniet corrupti voluptatem voluptatem ex mollitia.', 
                    src: 'https://cdn.vuetifyjs.com/images/cards/house.jpg', 
                    price: 12.30,
                    star: 12.30,
                    sales: 354,
                    flex: 12,
                    sale_date: "12/02/2020"
                },
                { 
                    id: 4,
                    product: 'Legacy Factors Engineer', 
                    category: 'Data', 
                    description: 'Odio laborum sequi similique veritatis non minima. Odio laborum sequi similique veritatis non minima. Odio laborum sequi similique veritatis non minima. Odio laborum sequi similique veritatis non minima.', 
                    src: 'https://cdn.vuetifyjs.com/images/cards/house.jpg', 
                    price: 12.30,
                    star: 12.30,
                    sales: 354,
                    flex: 12,
                    sale_date: "12/02/2020"
                },
            ],
        })
    }
</script>