<script setup>
import {computed, ref} from "vue";
import {Link, useForm} from "@inertiajs/vue3";

const step = ref(1)
const form = useForm({
    name: '',
    username: '',
    email: '',
    password: '',
    confirmPassword: '',
    remember: false,
})

const nextStep = () => {
    if (step.value === 1) step.value++
}

const prevStep = () => {
    if (step.value > 1) step.value--
}

const submit = () => {
    console.log("Submitting form", form)
}
</script>

<template>
    <h1 class="text-h4 font-weight-black mb-2">Sign Up</h1>

    <div class="d-flex align-center justify-space-between text-body-1 text-sm-h6 font-weight-regular mb-4">
        Already have an account?
        <Link href="/login" class="text-none">
            <v-btn
                variant="plain"
                class="px-0 opacity-100 text-none"
                text="Sign Up"
                color="primary"
            >
                Sign In
            </v-btn>
        </Link>
    </div>

    <v-window v-model="step">
        <v-window-item :value="1">
            <div class="mb-4">
                <v-label class="font-weight-bold" text="Full Name"/>
                <v-text-field
                    v-model="form.name"
                    density="comfortable"
                    variant="outlined"
                    placeholder="Enter your name"
                    color="primary"
                    :error-messages="form.errors.name"
                />
            </div>

            <div class="mb-4">
                <v-label class="font-weight-bold" text="Username"/>
                <v-text-field
                    v-model="form.username"
                    density="comfortable"
                    variant="outlined"
                    placeholder="Enter your username"
                    color="primary"
                    :error-messages="form.errors.username"
                />
            </div>

            <div class="mb-6">
                <v-label class="font-weight-bold" text="Email Address"/>
                <v-text-field
                    v-model="form.email"
                    density="comfortable"
                    variant="outlined"
                    placeholder="you@example.com"
                    color="primary"
                    :error-messages="form.errors.email"
                />
            </div>
        </v-window-item>

        <v-window-item :value="2">
            <div class="mb-4">
                <v-label class="font-weight-bold" text="Password"/>
                <v-text-field
                    v-model="form.password"
                    type="password"
                    density="comfortable"
                    variant="outlined"
                    placeholder="Enter your password"
                    hint="At least 8 characters"
                    color="primary"
                    persistent-hint
                    :error-messages="form.errors.password"
                />
            </div>

            <div>
                <v-label class="font-weight-bold" text="Confirm Password"/>
                <v-text-field
                    v-model="form.confirmPassword"
                    type="password"
                    density="comfortable"
                    variant="outlined"
                    placeholder="Re-enter your password"
                    color="primary"
                />
            </div>

            <div class="mb-4">
                <v-checkbox-btn
                    v-model="form.remember"
                    class="ms-n2"
                    label="Remember me"
                    color="primary"
                />
            </div>
        </v-window-item>
    </v-window>

    <div class="d-flex ga-2 ga-md-4">
        <v-btn v-if="step > 1"
               rounded="lg" color="grey-lighten-1"
               class="text-body-1 flex-grow-1"
               height="56" width="50" text="Prev"
               @click="prevStep"
        />

        <v-btn v-if="step < 2"
               rounded="lg" color="primary"
               class="text-body-1 flex-grow-1" height="56" width="50"
               text="Next" @click="nextStep"/>

        <v-btn v-else
               color="success" rounded="lg"
               class="text-body-1 flex-grow-1" height="56"
               width="50" text="Register"
               @click="submit"
        />
    </div>

    <v-divider class="my-8">
        <div class="text-no-wrap text-grey">Or continue with</div>
    </v-divider>

    <div class="d-flex ga-2 ga-md-4">
        <v-btn
            flat
            rounded="lg"
            variant="outlined"
            color="error"
            class="text-body-1 flex-grow-1"
            height="56" width="50"
            text="Google"
            prepend-icon="mdi-google"
        />
    </div>

</template>
