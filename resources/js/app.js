import './bootstrap';
// import '../css/app.css';
import '../css/style.css';

import "@mdi/font/css/materialdesignicons.css"; // Ensure you are using css-loader
import "@fortawesome/fontawesome-free/css/all.css";
// Ensure your project is capable of handling css files


import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import 'vuetify/styles'

import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import { fa } from "vuetify/iconsets/fa";
import { mdi } from "vuetify/lib/iconsets/mdi";

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: "mdi",
        sets: {
            mdi,
            fa,
        },
    },
})

const appName =
    import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`,
        import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(vuetify)

        .mount(el);
    },
    // progress: {
    //     color: '#4B5563',
    // },
});