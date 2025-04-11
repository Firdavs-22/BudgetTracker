<script setup>
import {ref} from "vue";
import {Link, router} from "@inertiajs/vue3";
import SubmitDialog from "@/components/submitDialog.vue";

defineProps({
    categories: Array,
    links: Object
});

const headers = [
    {key: "name", title: "Name"},
    {key: "type", title: "Transaction Type"},
    {key: "icon", title: "Icon", sortable: false},
    {key: "transaction_count", title: "Transactions", align: "center"},
    {key: "created_at", title: "Created At"},
    {key: "actions", title: "", align: "end", sortable: false},
];
const search = ref()
const dialog = ref(false)
const deletingItem = ref(null)

const confirmDelete = (category) => {
    dialog.value = true
    deletingItem.value = category
}

const closeDialog = () => {
    dialog.value = false
    deletingItem.value = null
}

const deleteAccount = () => {
    if (deletingItem.value) router.delete(`/category/${deletingItem.value.id}`, {
        onFinish() {
            closeDialog()
        },
    })
}
</script>
<!--Create Button-->
<!--A Category Table with a Search and Sorts and Pagination (Edit, Delete) Actions-->
<!--Add Any Statistics with filter (for example amount) + filter (by month, by day, ...)-->
<template>
    <v-card title="Category List" flat>
        <template v-slot:text>
            <div class="d-flex justify-space-between">
                <div>
                    <v-text-field
                        v-model="search"
                        label="Search"
                        prepend-inner-icon="mdi-magnify"
                        variant="outlined"
                        hide-details
                        density="compact"
                        single-line
                        width="350"
                    />
                </div>

                <div class="d-flex align-center">
                    <v-select
                        density="compact"
                        variant="solo-filled"
                        :items="['All','Month', 'Week', 'Day']"
                        model-value="All"
                        hide-details
                        class="me-4"
                    />

                    <Link href="/category/create" as="button">
                        <v-btn text="Create a new Category" color="secondary"/>
                    </Link>
                </div>
            </div>
        </template>

        <v-data-table
            :headers="headers"
            :items="categories"
            :search="search"
        >
            <template v-slot:item.type="{item}">
                <v-chip
                    :color="item.type === 'income' ? 'green' : 'red'"
                    text-color="white"
                    variant="tonal"
                    :prepend-icon="item.type === 'income' ? 'mdi-plus' : 'mdi-minus'"
                    class="ma-2"
                >
                    {{ item.type }}
                </v-chip>
            </template>

            <template v-slot:item.icon="{ item }">
                <v-chip
                    text-color="white"
                    variant="tonal"
                    label
                    color="surface-lighten"
                >
                    <v-icon :icon="'mdi-'+item.icon" :color="'#'+item.color"/>
                </v-chip>
            </template>

            <template v-slot:item.transaction_count="{ item }">
                <v-chip
                    text-color="white"
                    variant="tonal"
                    label
                    color="surface-lighten"
                >
                    {{ item.transaction_count }} times
                </v-chip>
            </template>

            <template v-slot:item.actions="{ item }">
                <div class="d-flex ga-2 justify-end">
                    <Link class="text-decoration-none text-none" :href="`/category/${item.id}`">
                        <v-btn size="small" variant="tonal" color="secondary" density="comfortable" icon="mdi-eye"/>
                    </Link>
                    <Link class="text-decoration-none text-none" :href="`/category/edit/${item.id}`">
                        <v-btn size="small" variant="tonal" color="lime-darken-2" density="comfortable" icon="mdi-pencil"/>
                    </Link>
                    <v-btn size="small" variant="tonal" color="error" density="comfortable" icon="mdi-delete" @click="confirmDelete(item)"/>
                </div>
            </template>

            <template v-slot:no-data>
                <v-alert type="info" icon="mdi-information" density="comfortable" class="ma-2 text-body-1 font-weight-medium" text="No categories found"/>
            </template>

            <template v-slot:loading>
                <v-skeleton-loader type="table-row@10"/>
            </template>
        </v-data-table>
    </v-card>

    <submit-dialog
        :title="`Do You Want to Delete a ${deletingItem?.name} ?`"
        :text="`Are you sure you want to delete this ${deletingItem?.name} category? This action cannot be undone.`"
        :dialog="dialog"
        @close="closeDialog"
        @delete="deleteAccount"
    />
</template>
