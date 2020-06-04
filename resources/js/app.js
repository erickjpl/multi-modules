require('./bootstrap')

import Vue from 'vue'
import store from '@/store/index'
import Index from '@/pages/Index'
import router from '@/routes/index'
import vuetify from '@/plugins/vuetify'
import Money from '@/plugins/filters/money'
import ShortenText from '@/plugins/filters/shorten-text'
import GlobalComponents from '@/plugins/global/components'

import '@/plugins/chartist'
import '@/plugins/global/base'
import '@/plugins/vee-validate'

Vue.use(Money)
Vue.use(ShortenText)
Vue.use(GlobalComponents)
Vue.component('index', Index)

new Vue({
	router,
	store,
	vuetify
}).$mount('#app')