<script setup>
import {ref} from "vue";
import {usePage} from "@inertiajs/vue3";
import AppNavigation from "@/layouts/app/AppNavigation.vue";
import AppBar from "@/layouts/app/AppBar.vue";

const drawer = ref(true);
const {props} = usePage();
</script>

<template>
    <v-app>
        <v-layout v-if="props.auth.user">
            <AppNavigation :drawer="drawer"/>

            <AppBar
                :user="props.auth.user"
                @changeNav="drawer = !drawer"
            />

            <v-main>
                <v-container fluid>
                    <slot/>
                </v-container>
            </v-main>
        </v-layout>
    </v-app>
</template>

