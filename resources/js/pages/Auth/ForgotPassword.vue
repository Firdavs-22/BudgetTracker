<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import {ref} from "vue";

const currentWindow = ref(1)

const form = useForm({
    email: '',
    code: '',
    password: '',
    password_confirmation: '',
})

const submitEmail = () => {
    form.post("/forgot-password", {
        onSuccess: () => {
            currentWindow.value = 2
            form.reset("code", "password", "password_confirmation");
        }
    });
}

const submitCode = () => {
    form.post("/reset-password", {
        onSuccess: () => {
            form.reset()
        },
        onError: (errors) => {
            if (errors.email) {
                currentWindow.value = 1
            }
            form.reset("code", "password", "password_confirmation");
        }
    });
}
</script>

<template>
    <v-window v-model="currentWindow">
        <v-window-item :value="1">
            <h1 class="text-h4 font-weight-black mb-4">Reset Password</h1>
            <p class="text-body-1 mb-6">
                Enter your email address and we'll send you a verification code to reset your password.
            </p>

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

            <div class="d-flex ga-2 ga-md-4">
                <v-btn
                    flat
                    class="text-none flex-grow-1 text-uppercase"
                    color="grey"
                    rounded="lg"
                    slim
                    variant="elevated"
                    height="56"
                    text="Verify Code"
                    @click="() => currentWindow = 2"
                />
                <v-btn
                    flat
                    class="text-none flex-grow-1 text-uppercase"
                    color="success"
                    rounded="lg"
                    slim
                    variant="elevated"
                    height="56"
                    text="Send Code"
                    @click="submitEmail"
                    :loading="form.processing"
                />
            </div>
        </v-window-item>

        <v-window-item :value="2">
            <h1 class="text-h4 font-weight-black mb-4">Enter Verification Code</h1>
            <p class="text-body-1 mb-6">
                We've sent a verification code to
                <span class="font-weight-bold">{{ form.email }}</span>.
                Please check your inbox and enter the code below to reset your password.
            </p>

            <div class="mb-2">
                <v-label class="font-weight-bold" text="Verification Code"/>
                <v-otp-input
                    v-model="form.code"
                    type="text"
                    length="6"
                />
                <span v-if="form.errors.code" class="text-caption ml-4" style="color: rgb(207,102,121)">{{ form.errors.code }}</span>
            </div>

            <div class="mb-2">
                <v-label class="font-weight-bold" text="New Password"/>
                <v-text-field
                    density="comfortable"
                    variant="outlined"
                    placeholder="********"
                    type="password"
                    color="primary"
                    v-model="form.password"
                    :error-messages="form.errors.password"
                />
            </div>

            <div class="mb-2">
                <v-label class="font-weight-bold" text="Confirm Password"/>
                <v-text-field
                    density="comfortable"
                    variant="outlined"
                    placeholder="********"
                    type="password"
                    color="primary"
                    v-model="form.password_confirmation"
                />
            </div>

            <div class="d-flex ga-2 ga-md-4">
                <v-btn
                    flat
                    class="text-none flex-grow-1 text-uppercase"
                    color="grey"
                    rounded="lg"
                    slim
                    variant="elevated"
                    height="56"
                    text="Back"
                    @click="() => currentWindow = 1"
                />
                <v-btn
                    flat
                    class="text-none flex-grow-1 text-uppercase"
                    color="success"
                    rounded="lg"
                    slim
                    variant="elevated"
                    height="56"
                    text="Reset Password"
                    @click="submitCode"
                    :loading="form.processing"
                />
            </div>
        </v-window-item>
    </v-window>


    <v-divider class="my-8">
        <div class="text-no-wrap text-grey">Remembered your password?</div>
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
    </div>
</template>

