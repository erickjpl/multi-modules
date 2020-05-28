<template>
  <v-container>
    <h2 class="display-2 mb-4">Basket</h2>

    <v-list two-line>
      <template v-for="(product, index) in products">
        <v-list-item :key="product.product_id">
          <v-list-item-avatar>
            <img :src="product.photo">
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title v-html="product.title"></v-list-item-title>
            <v-list-item-subtitle v-html="product.sub_title"></v-list-item-subtitle>
          </v-list-item-content>

          <v-list-item>
            {{product.price}}$
          </v-list-item>

          <v-list-item-action>
            <v-text-field label="Quantity" reverse :value="product.qty"></v-text-field>
          </v-list-item-action>

          <v-list-item>
            {{product.price * product.qty}}$
          </v-list-item>

          <v-list-item-action>
            <v-btn icon ripple>
              <v-icon color="red lighten-1">delete</v-icon>
            </v-btn>
          </v-list-item-action>
        </v-list-item>

        <v-divider v-if="index + 1 < products.length" :key="index"></v-divider>
      </template>
    </v-list>

    <v-container>
      <v-btn color="success" larger style="float: right;">Go to payment</v-btn>
    </v-container>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      products: [{
        product_id: 'kitchen-1',
        photo: 'https://cdn.vuetifyjs.com/images/cards/kitchen.png',
        title: 'QW cooking utensils',
        sub_title: 'Our vintage kitchen utenils delight any chef. Made of bamboo by hand',
        price: 14.99,
        qty: 1
      },{
        product_id: 'kitchen-2',
        photo: 'https://cdn.vuetifyjs.com/images/cards/kitchen.png',
        title: 'QW cooking utensils',
        sub_title: 'Our vintage kitchen utenils delight any chef. Made of bamboo by hand',
        price: 44.99,
        qty: 2
      },{
        product_id: 'kitchen-3',
        photo: 'https://cdn.vuetifyjs.com/images/cards/kitchen.png',
        title: 'QW cooking utensils',
        sub_title: 'Our vintage kitchen utenils delight any chef. Made of bamboo by hand',
        price: 64.99,
        qty: 2
      }]
    })
  }
</script>

<style scoped>

</style>
