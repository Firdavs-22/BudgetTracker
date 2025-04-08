<script setup>
import {Link, useForm} from "@inertiajs/vue3";

const form = useForm({
    email: '',
})


const submit = () => {
    form.post("forgot-password", {
        onSuccess: () => {
            form.reset();
        }
    });
}
</script>

<template>
    <h1 class="text-h4 font-weight-black mb-4">Reset Password</h1>

    <div class="mb-4">
        <v-label class="font-weight-bold" text="Email Address"/>
        <v-text-field
            density="comfortable"
            variant="outlined"
            placeholder="you@example.com"
            color="primary"
            v-model="form.email"
            :error-messages="form.errors.email"
        />
    </div>

    <v-btn
        block
        flat
        class="text-none text-uppercase"
        color="success"
        rounded="lg"
        slim
        variant="elevated"
        height="56"
        text="Send Password Reset"
        @click="submit"
    />

    <v-divider class="my-8">
        <div class="text-no-wrap text-grey">Or back to</div>
    </v-divider>

    <div class="d-flex ga-2 ga-md-4">
        <Link href="/login" class="text-none flex-grow-1 d-flex text-decoration-none">
            <v-btn
                flat
                rounded="lg"
                variant="outlined"
                color="secondary"
                class="text-body-1 flex-grow-1 text-none"
                height="56" width="50"
                text="Sign In"
            />
        </Link>
        <Link href="/register" class="text-none flex-grow-1 d-flex text-decoration-none">
            <v-btn
                flat
                rounded="lg"
                variant="outlined"
                color="primary"
                class="text-body-1 flex-grow-1 text-none"
                height="56" width="50"
                text="Sign Up"
            />
        </Link>
    </div>
</template>

