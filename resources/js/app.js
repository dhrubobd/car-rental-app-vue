import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  progress: {
    // The delay after which the progress bar will appear, in milliseconds...
    delay: 100,

    // The color of the progress bar...
    color: '#d251e0',

    // Whether to include the default NProgress styles...
    includeCSS: true,

    // Whether the NProgress spinner will be shown...
    showSpinner: true,
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(Toast, {
        position: 'top-right',
        timeout: 1000,
        closeOnClick: true,
        pauseOnHover: true,
        draggable: true,
        progress: false,
        icon: true,
        rtl:  false,
      })
      .mount(el)
  },
})
