require('./bootstrap')

import Vue from 'vue'
import Index from '@/pages/Index'
import router from '@/routes/index'
import vuetify from '@/plugins/vuetify'
import Money from '@/plugins/filters/money'
import ShortenText from '@/plugins/filters/shorten-text'
import GlobalComponents from '@/plugins/global/components'
import store from '@/store/index'
import '@/plugins/vee-validate'
import '@/plugins/base'
import '@/plugins/chartist'

Vue.use(Money)
Vue.use(ShortenText)
Vue.use(GlobalComponents)
Vue.component('index', Index)

new Vue({
	router,
	store,
	vuetify
}).$mount('#app')