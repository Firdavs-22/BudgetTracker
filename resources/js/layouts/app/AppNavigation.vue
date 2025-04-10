<script setup>
import NavigationItem from "@/layouts/app/NavigationItem.vue";
import {usePage} from "@inertiajs/vue3";

defineProps({
    drawer: Boolean,
    userProps: Object,
    items: Array,
});

const page = usePage();
const isActive = (route) => {
    if (route === "/"){
        return page.url === route;
    }
    return page.url.startsWith(route)
};
</script>

<template>
    <v-navigation-drawer :model-value="drawer" floating elevation="10">
        <div class="pb-4 pt-6 px-2">
            <v-img src="/logo.png" height="33"/>
        </div>

        <div class="px-2">
            <v-list density="comfortable" nav slim>
                <v-list-subheader title="Dashboard" class="font-weight-bold"/>
                <NavigationItem
                    v-for="item in items"
                    :key="item.route"
                    :active="isActive(item.route)"
                    :icon="item.icon"
                    :route="item.route"
                    :name="item.name"
                />
            </v-list>
        </div>
    </v-navigation-drawer>
</template>
