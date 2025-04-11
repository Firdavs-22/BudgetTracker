<template>
    <div>
        <v-dialog v-model="dialog" width="600">
            <template #activator="{ props }">
                <v-btn v-bind="props" :prepend-icon="selectedIcon && 'mdi-'+selectedIcon">
                    {{ selectedIcon ? selectedIcon.replace('mdi-', '') : 'Select Icon' }}
                </v-btn>
            </template>

            <v-card>
                <v-card-title class="d-flex align-center">
                    <span class="text-h5">Transaction Icons</span>
                    <v-spacer></v-spacer>
                    <v-text-field
                        v-model="search"
                        label="Search icons"
                        clearable
                        density="compact"
                        hide-details
                        prepend-inner-icon="mdi-magnify"
                    ></v-text-field>
                </v-card-title>

                <v-divider></v-divider>

                <v-card-text style="height: 400px" class="overflow-y-auto">
                    <v-row dense>
                        <v-col
                            v-for="icon in filteredIcons"
                            :key="icon"
                            cols="4"
                            sm="3"
                            md="2"
                        >
                            <v-card
                                variant="flat"
                                :color="selectedIcon === icon ? 'primary' : undefined"
                                @click="selectIcon(icon)"
                            >
                                <v-card-text class="text-center pa-2">
                                    <v-icon :icon="'mdi-'+icon" size="24"/>
                                    <div
                                        class="text-caption text-truncate mt-1"
                                        :class="selectedIcon === icon ? 'text-white' : 'text-disabled'"
                                    >
                                        {{ icon }}
                                    </div>
                                </v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn variant="text" @click="dialog = false">
                        Cancel
                    </v-btn>
                    <v-btn color="primary" variant="text" @click="confirmSelection">
                        Select
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script setup>
import {ref, computed} from 'vue';
import {transactionIcons} from '@/utils/icons';

const props = defineProps({
    modelValue: String,
});

const emit = defineEmits(['update:modelValue']);

const dialog = ref(false);
const search = ref('');
const selectedIcon = ref(props.modelValue);

const filteredIcons = computed(() => {
    if (!search.value) return transactionIcons;
    const query = search.value.toLowerCase();
    return transactionIcons.filter(icon =>
        icon.replace('mdi-', '').includes(query)
    );
});

function selectIcon(icon) {
    selectedIcon.value = icon;
}

function confirmSelection() {
    emit('update:modelValue', selectedIcon.value);
    dialog.value = false;
}
</script>

