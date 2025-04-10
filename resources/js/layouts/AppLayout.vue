<script setup>
import {ref} from "vue";
import {usePage} from "@inertiajs/vue3";
import AppNavigation from "@/layouts/app/AppNavigation.vue";
import AppBar from "@/layouts/app/AppBar.vue";

const drawer = ref(true);
const page = usePage();


</script>

<template>
    <v-app>
        <v-layout v-if="page.props.auth.user">
            <AppNavigation :drawer="drawer" />

            <AppBar
                @changeNav="drawer = !drawer"
                :userProps="page.props.auth"
            />

            <v-main>
                <v-container fluid>
                    <slot/>
                </v-container>
            </v-main>
        </v-layout>
    </v-app>
</template>

