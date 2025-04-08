<script setup>
import {ref} from "vue";
import {Link} from "@inertiajs/vue3";

const drawer = ref(false);
</script>

<template>
    <v-app>
        <v-navigation-drawer v-model="drawer">
            <v-list-item to="/" title="Home"/>
            <v-list-item to="/transactions" title="Transactions"/>
            <v-list-item to="/goals" title="Goals"/>
        </v-navigation-drawer>

        <v-app-bar color="primary">
            <v-app-bar-nav-icon @click="drawer = !drawer"/>
            <v-toolbar-title>BudgetTracker</v-toolbar-title>
            <v-spacer/>
            <Link href="/logout" method="post">
                <v-btn
                    variant="tonal"
                    text="Logout"
                    color="white"
                    class="mr-4"
                />
            </Link>
        </v-app-bar>

        <v-main>
            <v-container fluid>
                <slot/>
            </v-container>
        </v-main>
    </v-app>
</template>

