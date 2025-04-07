<script setup>
import {ref} from "vue";

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
        </v-app-bar>

        <v-main>
            <v-container fluid>
                <slot/>
            </v-container>
        </v-main>
    </v-app>
</template>

