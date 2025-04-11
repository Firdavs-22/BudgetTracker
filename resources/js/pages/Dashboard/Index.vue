<template>
    <div>
        <transaction-icon-picker v-model="selectedIcon"/>
        <div v-if="selectedIcon" class="mt-4">
            Selected Icon:
            <v-icon :icon="'mdi-'+selectedIcon"></v-icon>
            {{ selectedIcon }}
        </div>
    </div>
</template>

<script setup>
import {ref} from 'vue';
import TransactionIconPicker from '@/components/iconPicker.vue';

const selectedIcon = ref('store');
</script>
