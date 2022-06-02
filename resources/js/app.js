require('./bootstrap');

import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'

createInertiaApp({
    resolve: name => require(`./pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component('InertiaLink', Link)
            .component('InertiaHead', Head)
            .use(plugin)
            .mount(el)
    },
})
