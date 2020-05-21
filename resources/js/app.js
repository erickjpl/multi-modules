require('./bootstrap')

import Vue from 'vue'
import Index from '@/pages/Index'
import router from '@/routes/index'
import vuetify from '@/plugins/vuetify'
import ShortenText from '@/plugins/filters/shorten-text'

Vue.component('index', Index)
Vue.use(ShortenText)

new Vue({
	router,
	vuetify
}).$mount('#app')