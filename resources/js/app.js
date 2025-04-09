import {createApp, h} from "vue";
import {createInertiaApp} from "@inertiajs/vue3";
import {vuetify} from "@/plugins/vuetify.js";

import AppLayout from "@/layouts/AppLayout.vue";
import AuthLayout from "@/layouts/AuthLayout.vue";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', {eager: true});
        let page = pages[`./Pages/${name}.vue`];
        if (name.startsWith("Auth")){
            page.default.layout = AuthLayout;
        } else {
            page.default.layout = AppLayout;
        }
        return page;
    },
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .use(vuetify)
            .mount(el);
    }
})
