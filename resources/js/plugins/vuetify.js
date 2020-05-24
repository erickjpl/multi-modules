import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@/sass/overrides.sass'

Vue.use(Vuetify)

const theme = {
    primary: '#4CAF50',
    secondary: '#9C27b0',
    accent: '#9C27b0',
    info: '#00CAE3',
}

const opts = {
    theme: {
        themes: {
            dark: theme,
            light: theme,
        }
    }
}

export default new Vuetify(opts)