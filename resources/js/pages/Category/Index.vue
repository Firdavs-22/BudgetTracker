<script setup>
import {Link} from "@inertiajs/vue3";

const mostUsed = [
    2, 1, 2, 4, 3, 5, 3, 4, 3, 5, 1, 6, 2, 6, 4
]

</script>

<template>
    <v-responsive max-width="600">
        <p class="font-weight-medium opacity-60 mb-1">Analyze more easier</p>
        <h2 class="font-weight-bold text-h4 mb-4">Categories Statistics</h2>
        <p class="text-body-1 text-medium-emphasis">
            Analyze your categories with the most popular, most profitable, and most expansive categories.
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
                model-value="Month"
                hide-details
            />
        </div>
        <Link href="/category/list">
            <v-btn color="primary" text="Categories List"/>
        </Link>
    </div>

    <v-row dense class="my-2">
        <v-col sm="6" md="4" cols="12">
            <v-card elevation="4" rounded="lg">
                <div class="pa-4">
                    <div class="ps-4 text-caption text-medium-emphasis">Most Used</div>
                    <v-card-title class="pt-0 mt-n1 d-flex align-center">
                        <div class="me-2">20 times</div>
                        <v-chip variant="tonal" label size="x-small" color="error" text="1"
                                prepend-icon="mdi-arrow-down"/>
                    </v-card-title>
                </div>
                <v-sparkline
                    :gradient="['rgba(183, 28, 28, 0.8)', 'rgba(239, 83, 80,0.1)']"
                    gradient-direction="top"
                    line-width="2"
                    :model-value="mostUsed"
                    :smooth="10"
                    padding="0"
                    fill
                    type="trend"
                    auto-draw
                />
            </v-card>
        </v-col>
        <v-col sm="6" md="4" cols="12">
            <v-card elevation="4" rounded="lg">
                <div class="pa-4">
                    <div class="ps-4 text-caption text-medium-emphasis">Most Profitable</div>
                    <v-card-title class="pt-0 mt-n1 d-flex align-center">
                        <div class="me-2">20 times</div>
                        <v-chip variant="tonal" label size="x-small" color="error" text="1"
                                prepend-icon="mdi-arrow-down"/>
                    </v-card-title>
                </div>
                <v-sparkline
                    :gradient="['rgba(183, 28, 28, 0.8)', 'rgba(239, 83, 80,0.1)']"
                    gradient-direction="top"
                    line-width="2"
                    :model-value="mostUsed"
                    :smooth="10"
                    padding="0"
                    fill
                    type="trend"
                    auto-draw
                />
            </v-card>
        </v-col>
        <v-col sm="6" md="4" cols="12">
            <v-card elevation="4" rounded="lg">
                <div class="pa-4">
                    <div class="ps-4 text-caption text-medium-emphasis">Most Expansive</div>
                    <v-card-title class="pt-0 mt-n1 d-flex align-center">
                        <div class="me-2">20 times</div>
                        <v-chip variant="tonal" label size="x-small" color="error" text="1"
                                prepend-icon="mdi-arrow-down"/>
                    </v-card-title>
                </div>
                <v-sparkline
                    :gradient="['rgba(183, 28, 28, 0.8)', 'rgba(239, 83, 80,0.1)']"
                    gradient-direction="top"
                    line-width="2"
                    :model-value="mostUsed"
                    :smooth="10"
                    padding="0"
                    fill
                    type="trend"
                    auto-draw
                />
            </v-card>
        </v-col>
    </v-row>

    <div>Add Round Graphs for all Categories</div>
    <div>Add Multi Graphs for all Categories</div>

    <!--        <span>+with filter by months</span>-->
    <!--        <span>On this page has the List Button</span>-->
</template>
