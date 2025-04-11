<script setup>
defineProps({
    title: String,
    text: String,
    dialog: Boolean,
})
defineEmits(['close', 'delete'])
</script>

<template>
    <v-dialog :model-value="dialog" max-width="500" persistent hide-overlay>
        <v-card
            prepend-icon="mdi-delete"
            :title="title"
            :text="text"
        >
            <template v-slot:actions>
                <v-spacer/>

                <v-btn @click="$emit('close')">
                    Undo
                </v-btn>

                <v-btn @click="$emit('delete')">
                    Delete
                </v-btn>
            </template>
        </v-card>
    </v-dialog>
</template>
