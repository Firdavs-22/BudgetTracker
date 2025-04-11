<script setup>
import {useForm, Link} from "@inertiajs/vue3";
import IconPicker from '@/components/iconPicker.vue';

const props = defineProps({
    category: Object,
});

const form = useForm({
    name: props.category.name,
    type: props.category.type,
    color: '#' + props.category.color,
    icon: props.category.icon,
})

const updateCategory = () => {
    form.color = form.color.replace('#', '');
    form.put("/category/" + props.category.id);
}
</script>

<template>

    <div class="text-h5 font-weight-medium mb-6">Update a Category: {{category.name}}</div>
    <v-card class="pa-4 pa-md-6" border flat>
        <v-form>
            <v-row dense>
                <v-col md="8" cols="12">
                    <label class="text-subtitle-1 font-weight-medium mb-2 d-block">Category Name</label>
                    <v-text-field
                        density="comfortable"
                        variant="outlined"
                        placeholder="Salary, Shopping, etc..."
                        v-model="form.name"
                        :error-messages="form.errors.name"
                    />
                </v-col>
                <v-col md="4" cols="12">
                    <label class="text-subtitle-1 font-weight-medium mb-2 d-block">Transition Type</label>
                    <v-select
                        :append-icon="form.type === 'income'? 'mdi-plus' : 'mdi-minus'"
                        :icon-color="form.type === 'income'? 'green' : 'red'"
                        density="comfortable"
                        variant="outlined"
                        :items="['income','expense']"
                        v-model="form.type"
                        :error-messages="form.errors.type"
                    />
                </v-col>
                <v-col md="5" cols="12">
                    <label class="text-subtitle-1 font-weight-medium mb-2 d-block">Icon Color</label>
                    <v-color-picker hide-inputs mode="hex" v-model="form.color"/>
                </v-col>
                <v-col md="4" cols="12">
                    <label class="text-subtitle-1 font-weight-medium mb-2 d-block">Icon</label>
                    <IconPicker v-model="form.icon"/>
                    <div class="mt-4">
                        <v-chip
                            variant="tonal"
                            label
                            size="large"
                            color="surface-lighten"
                        >
                            <v-icon :icon="'mdi-'+form.icon" :color="form.color"/>
                        </v-chip>
                    </div>
                </v-col>
            </v-row>
            <div class="mt-6">
                <Link href="/category/list" as="button" :disabled="form.processing">
                    <v-btn color="surface-light" class="mr-4" text="Back" :disabled="form.processing"/>
                </Link>
                <v-btn color="primary" text="Update" @click="updateCategory" :loading="form.processing"/>
            </div>
        </v-form>
    </v-card>
</template>
