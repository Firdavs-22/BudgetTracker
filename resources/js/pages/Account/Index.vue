<script setup>
import {router, Link} from "@inertiajs/vue3";

const props = defineProps({
    accounts: Array,
    auth: Object,
})

const selectAccount = (account) => {
    router.post("account/change",{
        account_id: account.id
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
            <v-card color="surface-light" rounded="lg" class="pa-4 flex-grow-1">
                <v-list-item rounded="0" variant="text" :title="account.name" :subtitle="account.amount +' '+ account.currency"/>

                <v-card-text class="text-medium-emphasis pt-2">
                    <div class="mb-2">{{account.description}}</div>
                    <v-btn color="primary" text="Select" variant="tonal"
                           :disabled="auth.current_account === account.id"
                           @click="selectAccount(account)"/>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</template>
