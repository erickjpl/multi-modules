import Vue from 'vue'

export default Vue.filter('shorten-text', function (value) {
    if (!value) return ''

    if (value.length > 185) 
        value = value.slice(0, 185) + "..."

    return value
})
