import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import Layout from './Layouts/Layout.vue';
import store from './components/store/store';
import axios from "axios";
import 'flowbite';
// import { InertiaProgress } from "@inertiajs/progress";
// InertiaProgress.init();

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


const ToastOptions = {
    // You can set your default options here
};

createInertiaApp({
    resolve: name => {
        const page = require(`./Pages/${name}`).default
        console.log(page.layout);
        page.layout = page.layout || Layout

        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(store)
            .use(plugin)
            .use(Toast, ToastOptions)
            .mixin({methods: {route: window.route}})
            .mount(el)
    },
})
