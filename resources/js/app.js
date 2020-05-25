require('./bootstrap')

import Vue from 'vue'
import Index from '@/pages/Index'
import router from '@/routes/index'
import vuetify from '@/plugins/vuetify'
import ShortenText from '@/plugins/filters/shorten-text'
import GlobalComponents from '@/plugins/global/components'
import store from '@/store/index'
import '@/plugins/vee-validate'
import '@/plugins/base'
import '@/plugins/chartist'

Vue.component('index', Index)
Vue.use(ShortenText)
Vue.use(GlobalComponents)

new Vue({
	router,
	store,
	vuetify
}).$mount('#app')