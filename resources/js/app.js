require('./bootstrap')

import Vue from 'vue'
import Index from '@/pages/Index'
import router from '@/routes/index'
import vuetify from '@/plugins/vuetify'
import ShortenText from '@/plugins/filters/shorten-text'
import GlobalComponents from '@/plugins/global/components'

Vue.component('index', Index)
Vue.use(ShortenText)
Vue.use(GlobalComponents)

new Vue({
	router,
	vuetify
}).$mount('#app')