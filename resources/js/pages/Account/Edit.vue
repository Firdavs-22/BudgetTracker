<script setup>
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    account: {
        type: Object,
        required: true
    }
});

const form = useForm({
    name: props.account.name,
    description: props.account.description,
    currency: props.account.currency
})

const updateAccount = () => {
    form.put(`/account/${props.account.id}`);
}
</script>

<template>
    <div class="text-h5 font-weight-medium mb-6">Update a Account: {{account.name}}</div>
    <v-card class="pa-4 pa-md-6" border flat>
        <v-form>
            <v-row dense>
                <v-col md="8" cols="12">
                    <label class="text-subtitle-1 font-weight-medium mb-2 d-block">Account Name</label>
                    <v-text-field
                        density="comfortable"
                        variant="outlined"
                        placeholder="Stream, Work, アルバイト, free-lance, etc..."
                        v-model="form.name"
                        :error-messages="form.errors.name"
                    />
                </v-col>
                <v-col md="4" cols="12">
                    <label class="text-subtitle-1 font-weight-medium mb-2 d-block">Account Currency</label>
                    <v-text-field
                        density="comfortable"
                        variant="outlined"
                        placeholder="$, €, £, ¥, UZS, etc..."
                        v-model="form.currency"
                        :error-messages="form.errors.currency"
                    />
                </v-col>
                <v-col cols="12">
                    <label class="text-subtitle-1 font-weight-medium mb-2 d-block">Account Description</label>
                    <v-textarea
                        rows="2"
                        density="comfortable"
                        variant="outlined"
                        placeholder="Enter Account Name"
                        v-model="form.description"
                        :error-messages="form.errors.description"
                    />
                </v-col>
            </v-row>
            <v-btn color="primary" text="Update" @click="updateAccount" :loading="form.processing"/>
        </v-form>
    </v-card>
</template>
