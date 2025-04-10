<script setup>
import NavigationItem from "@/layouts/app/NavigationItem.vue";

defineProps({
    drawer: Boolean,
    userProps: Object
});

</script>

<template>
    <v-navigation-drawer :model-value="drawer" floating elevation="10">
        <div class="pb-4 pt-6 px-2">
            <v-img src="/logo.png" height="33"/>
        </div>

        <div class="px-2">
            <v-list density="comfortable" nav slim>
                <v-list-subheader title="Dashboard" class="font-weight-bold"/>
                <NavigationItem icon="view-dashboard-variant" route="/dashboard" name="Dashboard"/>
                <NavigationItem icon="account-group-outline" route="/account" name="Accounts"/>
                <NavigationItem icon="shape-plus" route="/category" name="Categories"/>
            </v-list>
        </div>
    </v-navigation-drawer>
</template>
