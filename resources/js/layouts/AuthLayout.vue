<script setup>

</script>

<template>
    <v-app>
        <v-main class="bg-surface-light">
            <v-container fluid class="d-flex h-100 pa-md-0">
                <v-row no-gutters align="center">
                    <v-col lg="6" cols="12" class="d-flex justify-center">
                        <v-sheet elevation="5" rounded="xl" class="flex-1-1 pa-6 px-md-10 py-md-12" max-width="450">
                            <slot/>
                        </v-sheet>
                    </v-col>
                    <v-img
                        class="hidden-md-and-down flex-1-1"
                        height="900"
                        cover
                        src="https://images.unsplash.com/photo-1471897488648-5eae4ac6686b?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        gradient="to left, rgba(var(--v-theme-surface), 0) 50%, rgba(var(--v-theme-surface-light), 1)"
                    />
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>
