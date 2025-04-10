<script setup>
import {Link} from "@inertiajs/vue3";
defineProps({
    active: Boolean,
    icon: String,
    route: String,
    name: String,
})

</script>

<template>
    <Link :href="route" class="text-decoration-none text-high-emphasis">
        <v-list-item
            link
            :active="active"
            rounded="lg"
            :prepend-icon="'mdi-'+icon"
            :title="name"
        />
    </Link>
</template>

