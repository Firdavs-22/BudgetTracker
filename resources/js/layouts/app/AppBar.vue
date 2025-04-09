<script setup>
import {router} from "@inertiajs/vue3";

defineProps({
    user: {
        type: Object,
        required: true
    }
});

defineEmits(["changeNav"]);

const logout = () => {
    router.post("/logout")
};

</script>

<template>
    <v-app-bar class="px-3" title="App">
        <template v-slot:append>
            <span class="ml-1 text-body-1 font-weight-medium">{{ user.username }}</span>
            <v-btn class="ml-1" height="48" slim icon>
                <v-avatar icon="mdi-account" size="32"/>
                <v-menu activator="parent" open-on-hover close-delay="250">
                    <v-list density="compact" nav>
                        <v-list-item append-icon="mdi-cog-outline" link title="Settings"/>

                        <v-list-item append-icon="mdi-logout" link title="Logout" @click="logout"/>
                    </v-list>
                </v-menu>
            </v-btn>
        </template>

        <template v-slot:prepend>
            <v-app-bar-nav-icon @click="$emit('changeNav')" density="comfortable"/>
        </template>
    </v-app-bar>
</template>
