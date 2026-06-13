import { h } from 'vue'
import DefaultTheme from 'vitepress/theme'
import Logo from './Logo.vue'
import './custom.css'

// Extend the default theme and drop the InvoiceShelf brand lockup into the
// navbar title slot. Rendering it inline (instead of themeConfig.logo, which
// VitePress emits as an <img>) lets the wordmark use the page's Poppins web
// font and adapt to the active theme via currentColor.
export default {
    extends: DefaultTheme,
    Layout() {
        return h(DefaultTheme.Layout, null, {
            'nav-bar-title-before': () => h(Logo),
        })
    },
}
