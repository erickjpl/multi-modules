import Vue from 'vue'
import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

const requireComponent = require.context(
    '@/components/shopping-cart', true, /\.vue$/,
)

requireComponent.keys().forEach(fileName => {
    const componentConfig = requireComponent(fileName)

    const componentName = upperFirst(
        camelCase(fileName.replace(/^\.\//, '').replace(/\.\w+$/, '')),
    )

    Vue.component(`Shop${componentName}`, componentConfig.default || componentConfig)
})
