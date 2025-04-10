<script setup>
import {router, Link} from "@inertiajs/vue3";
import {ref} from "vue";

defineProps({
    accounts: Array,
    auth: Object,
})

const dialog = ref(false)
const deletingItem = ref(null)

const selectAccount = (account) => {
    router.post("/account/change", {
        account_id: account.id
    })
}

const confirmDelete = (account) => {
    dialog.value = true
    deletingItem.value = account
}

const closeDialog = () => {
    dialog.value = false
    deletingItem.value = null
}

const deleteAccount = () => {
    if (deletingItem.value) router.delete(`/account/${deletingItem.value.id}`, {
        onFinish() {
            closeDialog()
        },
    })
}

</script>

<template>
    <div class="d-flex justify-space-between mb-3">
        <h3 class="text-h4 font-weight-bold mb-4">Your Accounts</h3>
        <Link href="/account/create" as="button">
            <v-btn text="Create a new Account" color="secondary"/>
        </Link>
    </div>
    <v-row>
        <v-col
            v-for="account in accounts" :key="account.id"
            md="4" cols="12" class="d-flex"
        >
            <v-card
                color="surface-light"
                rounded="lg"
                class="pa-2 flex-grow-1"
                :title="account.name"
                :subtitle="account.amount +' '+ account.currency"
            >
                <template v-slot:append>
                    <v-menu activator="parent">
                        <template v-slot:activator>
                            <v-btn flat icon="mdi-dots-vertical" size="sm" variant="text"/>
                        </template>

                        <v-list
                            bg-color="surface-light"
                            class="d-flex flex-column ga-1 pa-1"
                            density="compact"
                            rounded="lg"
                            variant="text"
                            slim
                        >
                            <Link :href="`/account/${account.id}`"
                                  class="text-decoration-none text-high-emphasis text-subtitle-2">
                                <v-list-item prepend-icon="mdi-pencil" rounded="lg" title="Edit" link/>
                            </Link>

                            <v-list-item prepend-icon="mdi-delete" @click="confirmDelete(account)" rounded="lg"
                                         title="Delete" link/>
                        </v-list>
                    </v-menu>
                </template>

                <v-card-text class="text-medium-emphasis pt-2">
                    <div class="mb-2">{{ account.description }}</div>
                    <v-btn color="primary" text="Select" variant="tonal"
                           :disabled="auth.current_account === account.id"
                           @click="selectAccount(account)"/>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>

    <v-dialog v-model="dialog" max-width="500" persistent hide-overlay>
        <v-card
            v-if="deletingItem"
            prepend-icon="mdi-delete"
            :title="`Do You Want to Delete a ${deletingItem.name} ?`"
            :text="`Are you sure you want to delete this ${deletingItem.name} account? This action cannot be undone.`"
        >
            <template v-slot:actions>
                <v-spacer/>

                <v-btn @click="closeDialog">
                    Undo
                </v-btn>

                <v-btn @click="deleteAccount">
                    Delete
                </v-btn>
            </template>
        </v-card>
    </v-dialog>
</template>
