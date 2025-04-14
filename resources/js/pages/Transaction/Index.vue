<script setup>
import {Link} from "@inertiajs/vue3";

</script>
<!--With Today Stats Income, Expense, Summary-->
<template>

    <v-responsive max-width="600">
        <p class="font-weight-medium opacity-60 mb-1">Analyze more easier</p>
        <h2 class="font-weight-bold text-h4 mb-4">Transaction Statistics</h2>
        <p class="text-body-1 text-medium-emphasis">
            Analyze your transaction with the Income, Expense, and Summary transaction by day.
            You can also filter the data by months and visualize it with graphs.
        </p>
    </v-responsive>

    <div class="d-flex justify-space-between mt-6 mb-4">
        <div class="d-flex align-center">
            <h2 class="text-h5 font-weight-medium text-truncate mr-5">Analytics</h2>
            <v-select
                density="compact"
                variant="solo-filled"
                :items="['Month', 'Week', 'Day']"
                model-value="Day"
                hide-details
            />
        </div>
        <div>
            <Link href="/transaction/create" class="mr-6">
                <v-btn color="secondary" text="Create transaction"/>
            </Link>

            <Link href="/transaction/list">
                <v-btn color="primary" text="Transactions List"/>
            </Link>
        </div>
    </div>

    <v-sheet color="surface" rounded="lg" elevation="0" class="py-4">
        <v-slide-group show-arrows>
            <v-slide-group-item v-for="i in 10" :key="i">
                <v-card
                    class="mr-4"
                    rounded="lg"
                    max-width="300"
                    min-width="250"
                    variant="tonal"
                    color="success"
                >
                    <v-card-item>
                        <v-card-subtitle class="mb-n2">Transaction</v-card-subtitle>
                        <v-card-title class="d-flex align-center justify-space-between">
                            <div class="text-white font-weight-bold text-h5">$10,0000</div>
                            <v-chip
                                label
                                variant="tonal"
                                text="Income"
                                color="success"
                                border="success thin opacity-25"
                                density="comfortable"
                                size="small"
                                prepend-icon="mdi-arrow-up"
                            />
                        </v-card-title>
                    </v-card-item>

                    <v-divider/>

                    <v-list slim>
                        <v-list-item rounded="0" title="給料">
                            <template v-slot:prepend>
                                <v-icon icon="mdi-credit-card" color="yellow"/>
                            </template>
                        </v-list-item>

                        <v-list-item
                            rounded="0"
                            title="May 22nd, 2024"
                            prepend-icon="mdi-calendar"
                        />
                        <v-tooltip location="bottom" width="300">
                            <template v-slot:activator="{ props }">
                                <v-list-item
                                    v-bind="props"
                                    rounded="0"
                                    title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, ratione debitis quis est labore voluptatibus! Eaque cupiditate minima"
                                    prepend-icon="mdi-text-long"
                                />
                            </template>
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, ratione debitis quis est labore voluptatibus! Eaque cupiditate minima</span>
                        </v-tooltip>
                    </v-list>
                </v-card>
            </v-slide-group-item>
        </v-slide-group>
    </v-sheet>

    <v-row class="mt-3">
        <v-col md="4" cols="12" v-for="i in 3">
            <v-card rounded="lg">
                <v-card-item class="py-4 ps-6">
                    <template v-slot:prepend>
                        <v-avatar color="primary" size="48" rounded icon="mdi-account-group-outline"/>
                    </template>

                    <v-card-title>
                        <div class="d-flex">
                            <div class="me-1">239</div>
                            <div class="d-flex align-center text-caption text-success">
                                <v-icon icon="mdi-arrow-up"/>
                                <span>2.5%</span>
                            </div>
                        </div>
                    </v-card-title>
                    <v-card-subtitle>Total users</v-card-subtitle>
                </v-card-item>
            </v-card>
        </v-col>
    </v-row>

</template>


