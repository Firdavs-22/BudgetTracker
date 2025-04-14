<script setup>
import {useForm, Link} from "@inertiajs/vue3";

 defineProps({
    categories: {
        type: Array,
        required: true
    },
});

const form = useForm({

})

const createTransaction = () => {

}
</script>

<template>
    <div class="text-h5 font-weight-medium mb-6">Create a Transaction</div>
    <v-card class="pa-4 pa-md-6" border flat>
        <v-form>
            <v-row dense>
                <v-col md="4" cols="12">
                    <label class="text-subtitle-1 font-weight-medium mb-2 d-block">Category Name</label>
                    <v-select :items="categories" item-value="id" item-title="name" return-object variant="outlined" density="comfortable">
                        <template v-slot:selection="{item}">
                            <div class="d-flex align-center">
                                <v-icon
                                    :color="'#' + item.raw.color"
                                    :icon="'mdi-' + item.raw.icon"
                                    class="mr-2"
                                />
                                <span>{{item.raw.name}}</span>
                            </div>
                        </template>

                        <template v-slot:item="{item,props}">
                            <v-list-item v-bind="props" class="text-white ma-2" rounded="lg">
                                <template v-slot:prepend>
                                    <v-icon :icon="'mdi-'+item.raw.icon"   :color="'#' + item.raw.color"/>
                                </template>

                                <v-list-item-title
                                    :class="item.raw.type === 'income' ? 'text-success': 'text-error'"
                                >
                                    {{ item.raw.type }}
                                </v-list-item-title>
                            </v-list-item>
                        </template>
                    </v-select>
                </v-col>
<!--                <v-col md="4" cols="12">-->
<!--                    <label class="text-subtitle-1 font-weight-medium mb-2 d-block">Transition Type</label>-->
<!--                    <v-select-->
<!--                        :append-icon="form.type === 'income'? 'mdi-plus' : 'mdi-minus'"-->
<!--                        :icon-color="form.type === 'income'? 'green' : 'red'"-->
<!--                        density="comfortable"-->
<!--                        variant="outlined"-->
<!--                        :items="['income','expense']"-->
<!--                        v-model="form.type"-->
<!--                        :error-messages="form.errors.type"-->
<!--                    />-->
<!--                </v-col>-->

            </v-row>
            <div class="mt-6">
                <Link href="/transaction/list" as="button" :disabled="form.processing">
                    <v-btn color="surface-light" class="mr-4" text="Back" :disabled="form.processing"/>
                </Link>
                <v-btn color="primary" text="Create" @click="createTransaction" :loading="form.processing"/>
            </div>
        </v-form>
    </v-card>
</template>
