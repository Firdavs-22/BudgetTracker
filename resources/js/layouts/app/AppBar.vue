<script setup>
import {router} from "@inertiajs/vue3";
import {ref, watch} from "vue";

const props = defineProps({
    userProps: {
        type: Object,
        required: true
    }
});

defineEmits(["changeNav"]);

const selectedAccount = ref(props.userProps.current_account)

const logout = () => {
    router.post("/logout")
};

const selectItem = (item) => ({
    value: item.id,
    title: item.name,
    subtitle: item.amount
})

const selectAccount = (newValue) => {
    if (newValue && newValue !== selectedAccount.value) {
        selectedAccount.value = newValue
        router.post("/account/change", {
            account_id: newValue
        })
    }
}

watch(() => props.userProps, (newValue) => {
    selectedAccount.value = newValue.current_account
});

</script>

<template>
    <v-app-bar class="px-3">
        <v-app-bar-title class="d-flex align-center">
            <v-select
                :model-value="selectedAccount"
                variant="outlined"
                density="compact"
                @update:modelValue="selectAccount"
                :items="userProps.user.accounts"
                :item-props="selectItem"
                :menu-props="{scrim: true, scrollStrategy: 'close'}"
                hide-details
            />
        </v-app-bar-title>

        <template v-slot:append>
            <v-btn height="48" slim>
                <span class="mr-2 text-body-1 font-weight-medium">{{ userProps.user.username }}</span>
                <v-avatar icon="mdi-account" size="32" color="surface-light"/>
                <v-menu activator="parent" open-on-hover close-delay="250">
                    <v-list density="compact" nav>
                        <v-list-item append-icon="mdi-cog-outline" link title="Settings"/>

                        <v-list-item append-icon="mdi-logout" link title="Logout" @click="logout"/>
                    </v-list>
                </v-menu>
            </v-btn>
        </template>

        <template v-slot:prepend>
            <v-app-bar-nav-icon @click="$emit('changeNav')" density="comfortable"/>
        </template>
    </v-app-bar>
</template>
