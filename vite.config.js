import {defineConfig} from 'vite';
import {fileURLToPath, URL} from 'node:url'
import laravel from 'laravel-vite-plugin';
import Vue from '@vitejs/plugin-vue';
import Vuetify from "vite-plugin-vuetify"
import vueDevTools from 'vite-plugin-vue-devtools'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/css/app.css'],
            refresh: true,
        }),
        Vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false
                }
            }
        }),
        vueDevTools(),
        Vuetify()
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/js', import.meta.url))
        },
        extensions: ['.js', '.vue']
    },
});
